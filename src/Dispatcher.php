<?php

namespace Modes\Bot;

use Modes\Bot\Filters\FilterInterface;
use Modes\Bot\Handle\Handle;
use Modes\Bot\Types\Update;

class Dispatcher
{
    private array $handlers;

    public function __construct(
        private readonly Api    $bot,
        private readonly array $handles,
    )
    {
        $this->handlersRegister();
    }

    public function runPoling(): void
    {
        while (true) {
            $updates = $this->bot->getUpdates();

            /** @var Update $update */
            foreach ($updates as $update) {
                $handler = $this->getHandler($update);
                $handler?->run($update);
            }

            sleep(3);
        }
    }

    private function getHandler(Update $update): ?HandlerInterface
    {
        foreach ($this->handlers as $handlerClass => $filters) {
            if (empty($filters)) {
                return new $handlerClass;
            }

            /** @var FilterInterface $filter */
            foreach ($filters as $filter) {
                if (
                    $update->message->text
                    && $filter->isTarget($update->message->text)
                ) {
                    return new $handlerClass;
                }
            }
        }

        return null;
    }

    private function handlersRegister(): void
    {
        /** @var Handle $handle */
        foreach ($this->handles as $handle) {
            $handlerClass = $handle->getHandler();
            if (is_subclass_of($handlerClass, HandlerInterface::class)) {
                $this->handlers[$handlerClass] = $handle->getFilters();
            }
        }
    }
}