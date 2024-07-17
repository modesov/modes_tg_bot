<?php

namespace App;

use Modes\Bot\Api;
use Modes\Bot\Types\Request\SendMessageParams;
use Modes\Bot\Types\Request\SetReactionParams;

class BotBlogger
{
    public function __construct(
        private Api $bot,
        private Channel $channel,
        private SourceInterface $source
    )
    {
    }

    public function run(): void
    {
        if (!$this->channel->isItTimeToSend()) {
           return;
        }

        $message = $this->source->getPost();
        if ($message) {
            $messageParams = new SendMessageParams($this->channel->getChatId(), $message);
            $response = $this->bot->sendMessage($messageParams);

            $messageId = (int)$response['result']['message_id'];
            $params = new SetReactionParams(
                $this->channel->getChatId(),
                $messageId,
                $this->channel->getAllowedEmoji()
            );
            $this->bot->setMessageReaction($params);

            $this->channel->setLastSendTime(time());
        }
    }
}