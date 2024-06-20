<?php

namespace App\Service;

interface WordCountStrategy
{
    public function countWords(string $message, array $wordsToMatch): array;
}