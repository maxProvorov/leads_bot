<?php

require __DIR__.'/vendor/autoload.php';
$config = require __DIR__.'/config.php';

use App\Bot;

$bot = new Bot($config['telegram']['bot_token']);
$url = urlencode($config['telegram']['webhook_url']);
$token = urlencode($config['telegram']['bot_token']);
file_get_contents("https://api.telegram.org/bot{$token}/setWebhook?url=$url");
echo "Webhook установлен!";