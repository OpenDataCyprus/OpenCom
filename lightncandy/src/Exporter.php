<?php
/*

Copyrights for code authored by Yahoo! Inc. is licensed under the following terms:
MIT License
Copyright (c) 2013-2016 Yahoo! Inc. All Rights Reserved.
Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:
The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.

Origin: https://github.com/zordius/lightncandy
*/

/**
 * file to keep LightnCandy Exporter
 *
 * @package    LightnCandy
 * @author     Zordius <zordius@yahoo-inc.com>
 */

namespace LightnCandy;

/**
 * LightnCandy major static class
 */
class Exporter
{
    /**
     * Get PHP code string from a closure of function as string
     *
     * @param array<string,array|string|integer> $context current compile context
     * @param object $closure Closure object
     *
     * @return string
     *
     * @expect 'function($a) {return;}' when input array('flags' => array('standalone' => 0)),  function ($a) {return;}
     * @expect 'function($a) {return;}' when input array('flags' => array('standalone' => 0)),   function ($a) {return;}
     */
    protected static function closure($context, $closure) {
        if (is_string($closure) && preg_match('/(.+)::(.+)/', $closure, $matched)) {
            $ref = new \ReflectionMethod($matched[1], $matched[2]);
        } else {
            $ref = new \ReflectionFunction($closure);
        }
        $fname = $ref->getFileName();

        $lines = file_get_contents($fname);
        $file = new \SplFileObject($fname);
        $file->seek($ref->getStartLine() - 2);
        $spos = $file->ftell();
        $file->seek($ref->getEndLine() - 1);
        $epos = $file->ftell();

        return preg_replace('/^.*?function(\s+[^\s\\(]+?)?\s*\\((.+)\\}.*?\s*$/s', 'function($2}', static::replaceSafeString($context, substr($lines, $spos, $epos - $spos)));
    }

    /**
     * Export required custom helper functions
     *
     * @param array<string,array|string|integer> $context current compile context
     *
     * @return string
     */
    public static function helpers($context) {
        $ret = '';
        foreach ($context['helpers'] as $name => $func) {
            if (!isset($context['usedCount']['helpers'][$name])) {
                continue;
            }
            if ((is_object($func) && ($func instanceof \Closure)) || ($context['flags']['exhlp'] == 0)) {
                $ret .= ("            '$name' => " . static::closure($context, $func) . ",\n");
                continue;
            }
            $ret .= "            '$name' => '$func',\n";
        }

        return "array($ret)";
    }

    /**
     * Replace SafeString class with alias class name
     *
     * @param array<string,array|string|integer> $context current compile context
     * @param string $str the PHP code to be replaced
     *
     * @return string
     */
    protected static function replaceSafeString($context, $str) {
        return $context['flags']['standalone'] ? str_replace($context['safestring'], $context['safestringalias'], $str) : $str;
    }

    /**
     * Export SafeString class as string
     *
     * @param array<string,array|string|integer> $context current compile context
     *
     * @return string
     */
    public static function safestring($context) {
        $class = new \ReflectionClass($context['safestring']);
        $methods = array();
        $ret = "if (!class_exists(\"" . addslashes($context['safestringalias']) . "\")) {\nclass {$context['safestringalias']} {\n";

        foreach ($class->getMethods() as $method) {
            $C = $method->getDeclaringClass();
            $fname = $C->getFileName();
            $lines = file_get_contents($fname);
            $file = new \SplFileObject($fname);
            $name = $method->getName();
            if ($name === 'stripExtendedComments') {
                continue;
            }
            $file->seek($method->getStartLine() - 2);
            $spos = $file->ftell();
            $file->seek($method->getEndLine() - 1);
            $epos = $file->ftell();
            $ret .= substr($lines, $spos, $epos - $spos);
        }
        unset($file);

        return "$ret}\n}\n";
    }

    /**
     * Export required standalone Runtime methods
     *
     * @param array<string,array|string|integer> $context current compile context
     *
     * @return string
     */
    public static function runtime($context) {
        $class = new \ReflectionClass($context['runtime']);
        $methods = array();
        $ret = '';

        foreach ($class->getMethods() as $method) {
            $C = $method->getDeclaringClass();
            $fname = $C->getFileName();
            $lines = file_get_contents($fname);
            $file = new \SplFileObject($fname);
            $name = $method->getName();
            $file->seek($method->getStartLine() - 2);
            $spos = $file->ftell();
            $file->seek($method->getEndLine() - 2);
            $epos = $file->ftell();
            $methods[$name] = static::scanDependency($context, preg_replace('/public static function (.+)\\(/', "function {$context['funcprefix']}\$1(", substr($lines, $spos, $epos - $spos)));
        }
        unset($file);

        $exports = array_keys($context['usedCount']['runtime']);

        while (true) {
            if (array_sum(array_map(function ($name) use (&$exports, $methods) {
                $n = 0;
                foreach ($methods[$name][1] as $child => $count) {
                    if (!in_array($child, $exports)) {
                       $exports[] = $child;
                       $n++;
                    }
                }
                return $n;
            }, $exports)) == 0) {
                break;
            }
        }

        foreach ($exports as $export) {
            $ret .= ($methods[$export][0] . " }\n");
        }

        return $ret;
    }

    /**
     * Export Runtime constants
     *
     * @param array<string,array|string|integer> $context current compile context
     *
     * @return string
     */
    public static function constants($context) {
        if ($context['flags']['standalone'] == 0) {
            return 'array()';
        }

        $class = new \ReflectionClass($context['runtime']);
        $constants = $class->getConstants();
        $ret = " array(\n";
        foreach($constants as $name => $value) {
            $ret .= "            '$name' => ".  (is_string($value) ? "'$value'" : $value ) . ",\n";
        }
        $ret .= "        )";
        return $ret;
    }

    /**
     * Scan for required standalone functions
     *
     * @param array<string,array|string|integer> $context current compile context
     * @param string $code PHP code string of the method
     *
     * @return array<string|array> list of converted code and children array
     */
    protected static function scanDependency($context, $code) {
        $child = array();

        $code = preg_replace_callback('/static::(\w+?)\s*\(/', function ($matches) use ($context, &$child) {
            if (!isset($child[$matches[1]])) {
                $child[$matches[1]] = 0;
            }
            $child[$matches[1]]++;

            return "{$context['funcprefix']}{$matches[1]}(";
        }, $code);

        // replace the constants
        $code = preg_replace('/static::([A-Z0-9_]+)/', "\$cx['constants']['$1']", $code);

        // compress space
        $code = preg_replace('/    /', ' ', $code);

        return array(static::replaceSafeString($context, $code), $child);
    }
}

