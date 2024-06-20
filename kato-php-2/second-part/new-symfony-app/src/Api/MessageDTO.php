<?php

namespace App\Api;

class MessageDTO
{
    private string $message;

    public function __construct(string $message)
    {
        $this->message = $message;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public static function isValid(array $data): bool
    {
        return isset($data['message']) && is_string($data['message']);
    }
}