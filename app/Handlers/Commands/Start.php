<?php
namespace App\Handlers\Commands;

use Modes\Bot\HandlerInterface;
use Modes\Bot\Types\Update;

class Start implements HandlerInterface
{
    public function run(Update $update): void
    {
        $update->message->sendMessage('Привет старт');
    }
}