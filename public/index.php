<?php

require dirname(__DIR__, 1) . '/vendor/autoload.php';

use App\Example;

$example = new Example();
echo $example->hello();