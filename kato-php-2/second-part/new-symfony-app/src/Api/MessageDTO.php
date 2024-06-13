<?php

namespace App\Api;

class MessageDTO
{
    public string $message;

    public function __construct(string $message)
    {
        $this->message = $message;
    }
}