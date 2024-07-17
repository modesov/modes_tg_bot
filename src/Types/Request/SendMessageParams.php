<?php

namespace Modes\Bot\Types\Request;

class SendMessageParams
{
    public function __construct(
        public readonly string | int $chatId,
        public readonly string $message,
        public readonly ?string $parseMode = null,
    )
    {
    }
}