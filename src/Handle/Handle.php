<?php

namespace Modes\Bot\Handle;

class Handle
{
    public function __construct(
        private string $handler,
        private ?array $filters = null
    )
    {
    }

    public function getFilters(): ?array
    {
        return $this->filters;
    }

    public function getHandler(): string
    {
        return $this->handler;
    }

}