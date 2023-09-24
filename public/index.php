<?php

require dirname(__DIR__, 1) . '/vendor/autoload.php';

if (filter_input(INPUT_GET, 'phpinfo')) {
    phpinfo();
    exit;
}

echo \App\HelloWorld::sayHello();
