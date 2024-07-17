<?php

namespace App;

class Channel
{
    public function __construct(
        private int    $chatId,
        private string $name,
        private array  $allowedEmoji,
        private int    $minTime = 60 * 60, // от часа,
        private int    $maxTime = 60 * 60 * 2 // до 2 часов
    )
    {
    }

    public function getAllowedEmoji(): array
    {
        return $this->allowedEmoji;
    }

    public function getChatId(): int
    {
        return $this->chatId;
    }

    public function isItTimeToSend(): bool
    {
        $fileLog = dirname(__DIR__) . "/logs/{$this->name}/last_send.log";
        $lastSendTime = file_exists($fileLog) ? (int)file_get_contents($fileLog) : false;
        $randTime = mt_rand($this->minTime, $this->maxTime);
        $currentTime = time();
        $deltaTime = $currentTime - $lastSendTime;

        return !$lastSendTime || $deltaTime >= $randTime;
    }

    public function setLastSendTime(int $time): void
    {
        file_put_contents(dirname(__DIR__) . "/logs/{$this->name}/last_send.log", $time);
    }
}