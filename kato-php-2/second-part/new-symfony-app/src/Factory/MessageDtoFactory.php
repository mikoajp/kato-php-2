<?php

namespace App\Factory;

use App\Api\MessageDTO;
use InvalidArgumentException;

class MessageDtoFactory
{
    public function create(array $data): MessageDTO
    {
        if (!MessageDTO::isValid($data)) {
            throw new InvalidArgumentException('Invalid data provided.');
        }

        return new MessageDTO($data['message'], $data['wordsToMatch']);
    }
}