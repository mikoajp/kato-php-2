<?php

namespace App\Controller;

use App\Service\MessageService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiController
{
    private MessageService $messageService;

    public function __construct(
        MessageService $messageService,
    ) {
        $this->messageService = $messageService;
    }

    public function processMessage(Request $request): JsonResponse
    {
        $data = $this->getRequestData($request);

        if ($data === null) {
            return new JsonResponse(['error' => 'Invalid JSON data.'], Response::HTTP_BAD_REQUEST);
        }

        try {
            $dto = $this->messageService->create($data);
        } catch (\InvalidArgumentException $e) {
            return new JsonResponse(['error' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }

        $originalMessage = $dto->getMessage();
        $trimmedMessage = $this->trimMessage($originalMessage);
        $wordCounts = $this->processMessageAndCountWords($trimmedMessage);

        return new JsonResponse([
            'original_message' => $originalMessage,
            'word_counts' => $wordCounts
        ], Response::HTTP_OK);
    }

    private function getRequestData(Request $request): ?array
    {
        $data = json_decode($request->getContent(), true);

        return json_last_error() === JSON_ERROR_NONE ? $data : null;
    }

    private function trimMessage(string $message): string
    {
        return preg_replace('/[^hello|text]/i', '', $message);
    }

    private function processMessageAndCountWords(string $message): array
    {
        $wordsToMatch = ['hello', 'text'];
        return $this->messageService->countWords($message, $wordsToMatch);
    }
}