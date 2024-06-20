<?php

namespace App\Api;

interface WordCountInterface
{
    public function countWords(string $message, array $wordsToMatch): array;
}