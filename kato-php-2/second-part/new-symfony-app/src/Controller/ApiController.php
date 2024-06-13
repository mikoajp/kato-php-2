<?php

namespace App\Controller;

use App\Api\MessageDTO;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ApiController extends AbstractController
{
    public function processMessage(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        if (!isset($data['message'])) {
            return new JsonResponse(['error' => 'Invalid request: "message" field is required'], 400);
        }

        $dto = new MessageDto($data['message']);

        $message = $dto->message;
        $wordsToMatch = ['hello', 'text'];
        $wordCount = [];

        foreach ($wordsToMatch as $word) {
            $count = substr_count(strtolower($message), $word);
            $wordCount[$word] = $count;
        }

        $responseData = [
            'message' => $message,
            'count' => $wordCount
        ];

        return new JsonResponse($responseData);
    }
}
