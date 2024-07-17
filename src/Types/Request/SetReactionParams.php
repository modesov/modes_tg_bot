<?php

namespace Modes\Bot\Types\Request;

class SetReactionParams
{
    public readonly string $reaction;

    public function __construct(
        public readonly string | int $chatId,
        public readonly int $messageId,
        public readonly array $allowedEmoji
    )
    {
        $randomEmoji =  $this->allowedEmoji[array_rand($this->allowedEmoji)];
        $this->reaction = json_encode([
            ['type' => 'emoji', 'emoji' => $randomEmoji],
        ]);
    }
}