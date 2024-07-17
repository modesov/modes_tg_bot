<?php

namespace Modes\Bot\Types;

use Modes\Bot\Api;

class Update
{
    public int $id;
    public Message $message;

    private Api $bot;

    public function __construct(Api $bot, array $arUpdate)
    {
        $this->bot = $bot;
        $this->id = $arUpdate['update_id'];
        $this->message = new Message($bot, $arUpdate['message']);
    }
}