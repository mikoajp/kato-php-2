<?php

namespace App\Service;

class MessageProcessorService
{
    private WordCountStrategy $wordCountStrategy;

    public function __construct(WordCountStrategy $wordCountStrategy)
    {
        $this->wordCountStrategy = $wordCountStrategy;
    }

    public function countWords(string $message, array $wordsToMatch): array
    {
        return $this->wordCountStrategy->countWords($message, $wordsToMatch);
    }
}