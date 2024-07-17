<?php

namespace Modes\Bot\Types;

class From
{
    public int $id;
    public bool $isBot;
    public string $firstName;
    public string $lastName;
    public string $username;
    public string $languageCode;

    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->isBot = $data['is_bot'];
        $this->firstName = $data['first_name'] ?: '';
        $this->lastName = $data['last_name'] ?: '';
        $this->username = $data['username'] ?: '';
        $this->languageCode = $data['language_code'] ?: '';
    }

}