<?php

namespace Modes\Bot\Types;

class Entity
{
    public int $offset;
    public int $length;
    public string $type;

    public function __construct(array $data)
    {
        $this->offset = $data['offset'];
        $this->length = $data['length'];
        $this->type = $data['type'];
    }
}