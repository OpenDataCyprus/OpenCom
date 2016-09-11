<?php


require_once('vendor/autoload.php');



use LightnCandy\LightnCandy;



$template = "Welcome {{name}} , You win \${{value}} dollars!!\n";
$phpStr = LightnCandy::compile($template);  // set compiled PHP code into $phpStr

// Quick and deprecated way to get render function
$renderer = LightnCandy::prepare($phpStr);

// Render by different data
echo "Template is:\n$template\n";


echo $renderer(array('name' => 'John', 'value' => 10000));