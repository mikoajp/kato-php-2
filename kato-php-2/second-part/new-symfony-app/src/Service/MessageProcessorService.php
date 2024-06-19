<?php

namespace App\Service;

use App\Service\WordCountStrategy\WordCountStrategy;

class MessageProcessorService
{
    private WordCountStrategy $wordCountStrategy;

    public function __construct(WordCountStrategy $wordCountStrategy)
    {
        $this->wordCountStrategy = $wordCountStrategy;
    }

    public function countWords(string $message, array $wordsToMatch): int
    {
        return $this->wordCountStrategy->countWords($message, $wordsToMatch);
    }
}