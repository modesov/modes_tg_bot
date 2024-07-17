<?php

namespace Modes\Bot\Filters;

interface FilterInterface
{
    public function isTarget(string $str): bool;
}