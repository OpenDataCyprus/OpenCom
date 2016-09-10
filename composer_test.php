<?php


require_once('handlebars/src/Handlebars/autoload.php');

use LightnCandy\LightnCandy;


LightnCandy::compile($template, Array(
    'flags' => LightnCandy::FLAG_ERROR_LOG | LightnCandy::FLAG_STANDALONEPHP
));