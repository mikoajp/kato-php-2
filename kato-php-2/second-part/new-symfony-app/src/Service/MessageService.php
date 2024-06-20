<?php

namespace App\Service;

use App\Api\MessageDTO;
use App\Api\WordCountInterface;
use InvalidArgumentException;

class MessageService
{
    private WordCountInterface $wordCountInterface;

    public function __construct(WordCountInterface $wordCountInterface)
    {
        $this->wordCountInterface = $wordCountInterface;
    }

    public function countWords(string $message, array $wordsToMatch): array
    {
        return $this->wordCountInterface->countWords($message, $wordsToMatch);
    }
    public function create(array $data): MessageDTO
    {
        if (!MessageDTO::isValid($data)) {
            throw new InvalidArgumentException('Invalid data provided.');
        }

        return new MessageDTO($data['message']);
    }

}