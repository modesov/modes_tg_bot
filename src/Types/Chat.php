<?php

namespace Modes\Bot\Types;

class Chat
{
    public int $id;
    public string $firstName;
    public string $lastName;
    public string $username;
    public string $type;

    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->firstName = $data['first_name'];
        $this->lastName = $data['last_name'];
        $this->username = $data['username'];
        $this->type = $data['type'];
    }

}