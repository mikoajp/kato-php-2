<?php

namespace App\Api;

class MessageDTO
{
    private string $message;
    private array $wordsToMatch;

    public function __construct(string $message, array $wordsToMatch)
    {
        $this->message = $message;
        $this->wordsToMatch = $wordsToMatch;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getWordsToMatch(): array
    {
        return $this->wordsToMatch;
    }

    public static function isValid(array $data): bool
    {
        if (!isset($data['message']) || !is_string($data['message'])) {
            return false;
        }

        if (!isset($data['wordsToMatch']) || !is_array($data['wordsToMatch'])) {
            return false;
        }

        return true;
    }
}