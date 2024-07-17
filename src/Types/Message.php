<?php

namespace Modes\Bot\Types;

use Modes\Bot\Api;
use Modes\Bot\Types\Request\SendMessageParams;

class Message
{
    public int $id;
    public From $from;
    public Chat $chat;
    public int $date;
    public ?string $text;
    public array $photo = [];
    public ?string $mediaGroupId;
    public array $entities = [];
    private Api $bot;

    public function __construct(Api $bot, array $arMessage)
    {
        $this->bot = $bot;
        $this->id = $arMessage['message_id'];
        $this->from = new From($arMessage['from']);
        $this->chat = new Chat($arMessage['chat']);
        $this->date = $arMessage['date'];
        $this->text = $arMessage['text'] ?? null;
        $this->mediaGroupId = $arMessage['media_group_id'] ?? null;

        if (
            isset($arMessage['entities'])
            && is_array($arMessage['entities'])
        ) {
            $this->entities = array_map(function ($entity) {
                return new Entity($entity);
            }, $arMessage['entities']);
        }

        if (
            isset($arMessage['photo'])
            && is_array($arMessage['photo'])
        ) {
            $this->photo = array_map(function ($photo) {
                return new Photo($photo);
            }, $arMessage['photo']);
        }
    }

    public function sendMessage(string $message, string $parseMode = null): void
    {
        $this->bot->sendMessage(new SendMessageParams(
            chatId: $this->chat->id,
            message: $message,
            parseMode: $parseMode
        ));
    }

}