<?php

require  __DIR__ . '/vendor/autoload.php';
$config = require  __DIR__ . '/config.php';

use App\Bot;

$bot = new Bot($config);
$bot->handle();