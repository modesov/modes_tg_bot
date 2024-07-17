<?php
namespace App\Handlers\Commands;

use Modes\Bot\HandlerInterface;
use Modes\Bot\Types\Update;

class Help implements HandlerInterface
{
    public function run(Update $update): void
    {
        $update->message->sendMessage('Привет помощь');
    }
}