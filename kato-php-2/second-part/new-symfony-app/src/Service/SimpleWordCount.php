<?php

namespace App\Service;

use App\Api\WordCountInterface;

class SimpleWordCount implements WordCountInterface
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