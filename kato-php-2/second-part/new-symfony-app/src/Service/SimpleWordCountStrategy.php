<?php

namespace App\Service;

class SimpleWordCountStrategy implements WordCountStrategy
{
    public function countWords(string $message, array $wordsToMatch): array
    {
        $wordCounts = [];
        foreach ($wordsToMatch as $word) {
            $wordCounts[$word] = substr_count(strtolower($message), strtolower($word));
        }
        return $wordCounts;
    }
}