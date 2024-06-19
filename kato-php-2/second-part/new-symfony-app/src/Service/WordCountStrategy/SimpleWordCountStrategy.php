<?php

namespace App\Service\WordCountStrategy;

class SimpleWordCountStrategy implements WordCountStrategy
{
    public function countWords(string $message, array $wordsToMatch): int
    {
        $wordCount = 0;
        foreach ($wordsToMatch as $word) {
            $wordCount += substr_count($message, $word);
        }
        return $wordCount;
    }
}