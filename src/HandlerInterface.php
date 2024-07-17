<?php

namespace Modes\Bot;

use Modes\Bot\Types\Update;

interface HandlerInterface
{
    public function run(Update $update): void;

}