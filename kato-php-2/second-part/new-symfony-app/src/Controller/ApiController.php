<?php

namespace App\Controller;

use App\Factory\MessageDtoFactory;
use App\Service\MessageProcessorService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class ApiController
{
    private MessageProcessorService $messageProcessorService;
    private MessageDtoFactory $messageDtoFactory;

    public function __construct(
        MessageProcessorService $messageProcessorService,
        MessageDtoFactory $messageDtoFactory
    ) {
        $this->messageProcessorService = $messageProcessorService;
        $this->messageDtoFactory = $messageDtoFactory;
    }

    public function processMessage(Request $request): JsonResponse
    {
        $data = $this->getRequestData($request);

        if ($data === null) {
            return new JsonResponse(['error' => 'Invalid JSON data.'], Response::HTTP_BAD_REQUEST);
        }

        try {
            $dto = $this->messageDtoFactory->create($data);
        } catch (\InvalidArgumentException $e) {
            return new JsonResponse(['error' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }

        $wordCount = $this->processMessageAndCountWords($dto);

        return new JsonResponse([
            'message' => $dto->getMessage(),
            'count' => $wordCount
        ], Response::HTTP_OK);
    }

    private function getRequestData(Request $request): ?array
    {
        $data = json_decode($request->getContent(), true);

        return json_last_error() === JSON_ERROR_NONE ? $data : null;
    }

    private function processMessageAndCountWords($dto): int
    {
        $message = $dto->getMessage();
        $wordsToMatch = $dto->getWordsToMatch();

        return $this->messageProcessorService->countWords($message, $wordsToMatch);
    }
}