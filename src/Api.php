<?php

namespace Modes\Bot;

use Modes\Bot\Types\Request\SendMessageParams;
use Modes\Bot\Types\Request\SetReactionParams;
use Modes\Bot\Types\Update;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

class Api
{
    private int $lastUpdate = 0;
    private HttpClientInterface $httpClient;

    public function __construct(
        private readonly string $token,
    )
    {
        $this->httpClient = HttpClient::createForBaseUri('https://api.telegram.org/bot' . $this->token . '/');
    }

    public function setLastUpdate(int $lastUpdate): void
    {
        $this->lastUpdate = $lastUpdate;
    }

    public function getUpdates(): array
    {
        $result = [];
        $offset = $this->lastUpdate > 0 ? $this->lastUpdate + 1 : 0;
        $response = $this->sendRequest('getUpdates', ['json' => ['offset' => $offset]])->toArray();
        if (
            $response['ok']
            && count($response['result']) > 0
        ) {
            $result = array_map(fn ($update) => new Update($this, $update), $response['result']);
            $lastUpdate = $result[array_key_last($result)];
            $this->setLastUpdate($lastUpdate->id);
        }

        return $result;
    }

    public function sendMessage(SendMessageParams $params): array
    {
        $data = [
            'chat_id' => $params->chatId,
            'text' => $params->message,
        ];

        if ($params->parseMode) {
            $data['parse_mode'] = $params->parseMode;
        }

        return $this->sendRequest(
            'sendMessage',
            [
                'json' => $data
            ]
        )->toArray();
    }

    public function setMessageReaction(SetReactionParams $params): array
    {
        return $this->sendRequest(
            'setMessageReaction',
            [
                'json' => [
                    'chat_id' => $params->chatId,
                    'message_id' => $params->messageId,
                    'reaction' => $params->reaction,
                ]
            ]
        )->toArray();
    }

    private function sendRequest(string $apiMethod, array $requestBody): ResponseInterface
    {
        return $this->httpClient->request('POST', $apiMethod, $requestBody);
    }
}