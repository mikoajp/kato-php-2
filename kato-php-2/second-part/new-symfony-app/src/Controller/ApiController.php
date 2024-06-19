<?php

namespace App\Controller;

use App\Api\MessageDTO;
use App\Factory\MessageDtoFactory;
use App\Service\MessageProcessorService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiController
{
    public function __invoke(
        Request $request,
        MessageProcessorService $messageProcessorService,
        MessageDtoFactory $messageDtoFactory
    ) : JsonResponse
    {
        $data = $this->getRequestData($request);

        if ($data === null) {
            return new JsonResponse(['error' => 'Invalid JSON data.'], Response::HTTP_BAD_REQUEST);
        }

        try {
            $dto = $messageDtoFactory->create($data);
        } catch (\InvalidArgumentException $e) {
            return new JsonResponse(['error' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }

        return new JsonResponse([
            'message' => $dto->getMessage(),
            'count' => $this->processMessageAndCountWords($dto, $messageProcessorService)
        ], Response::HTTP_OK);
    }

    private function getRequestData(Request $request): ?array
    {
        $data = json_decode($request->getContent(), true);

        return json_last_error() === JSON_ERROR_NONE ? $data : null;
    }

    private function processMessageAndCountWords(MessageDTO $dto, MessageProcessorService $messageProcessorService): int
    {
        $message = $dto->getMessage();
        $wordsToMatch = $dto->getWordsToMatch();

        return $messageProcessorService->countWords($message, $wordsToMatch);
    }
}