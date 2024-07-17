<?php
require __DIR__ . '/vendor/autoload.php';

use Modes\Bot\Api;
use Modes\Bot\Dispatcher;
use Symfony\Component\Dotenv\Dotenv;

$dotenv = new Dotenv();
$dotenv->load(__DIR__.'/.env');

$bot = new Api(token: $_ENV['BOT_TOKEN']);
$handles = include __DIR__ . '/handles/common.php';
$dispatcher = new Dispatcher(bot: $bot, handles: $handles);
$dispatcher->runPoling();