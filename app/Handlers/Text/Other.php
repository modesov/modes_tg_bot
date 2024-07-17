<?php

namespace App\Handlers\Text;

use Modes\Bot\HandlerInterface;
use Modes\Bot\Types\Update;

class Other implements HandlerInterface
{
    public function run(Update $update): void
    {
        $message = $update->message;
        if ($message->text) {
            $message->sendMessage('<b>'.$message->text. '</b>', 'HTML');
        }

    }
}