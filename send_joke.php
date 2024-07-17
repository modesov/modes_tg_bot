<?php
require __DIR__ . '/vendor/autoload.php';

use App\BotBlogger;
use App\Channel;
use App\RzhuSource;
use Modes\Bot\Api;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\Dotenv\Dotenv;

$dotenv = new Dotenv();
$dotenv->load(__DIR__.'/.env');

try {
    file_put_contents(__DIR__ . '/logs/joke/sends.log', date('d.m.Y H:i:s') . "\n", FILE_APPEND);

    $bot = new Api(token: $_ENV['BOT_TOKEN']);
    $channel = new Channel(
        chatId: -1002245260612,
        name: 'joke',
        allowedEmoji: ["🤣", "😁", "🤩", "🤓", "👍", "🔥", "❤️", "👏", "🤡", "🥱", "🥴", "⚡️", "🙊"]
    );
    $httpClient = HttpClient::create();
    $source = new RzhuSource(httpClient: $httpClient, category: 'anecdote');
    $botBlogger = new BotBlogger(bot: $bot, channel: $channel, source: $source);
    $botBlogger->run();
} catch (Exception $exception) {
    dd($exception->getMessage());
}

