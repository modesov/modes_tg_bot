<?php

namespace Modes\Bot\Filters;

class Command implements FilterInterface
{
    public function __construct(
        private string $name,
        private string $prefix = '/'
    )
    {
    }

    public function isTarget(string $str): bool
    {
        return trim($str) === $this->prefix . $this->name;
    }
}