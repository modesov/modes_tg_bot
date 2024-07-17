<?php

use Modes\Bot\Handle\Handle;

return [
    new Handle(\App\Handlers\Commands\Start::class, [new \Modes\Bot\Filters\Command('start')]),
    new Handle(\App\Handlers\Commands\Help::class, [new \Modes\Bot\Filters\Command('help')]),
    new Handle(\App\Handlers\Text\Other::class)
];
