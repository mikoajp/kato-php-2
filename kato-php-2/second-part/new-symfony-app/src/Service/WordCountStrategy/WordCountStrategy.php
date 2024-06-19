<?php

namespace App\Service\WordCountStrategy;

interface WordCountStrategy
{
    public function countWords(string $message, array $wordsToMatch): int;
}