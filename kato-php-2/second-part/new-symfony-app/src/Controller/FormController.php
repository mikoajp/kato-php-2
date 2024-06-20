<?php

namespace App\Controller;

use App\Service\MessageProcessorService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class FormController extends AbstractController
{
    private MessageProcessorService $messageProcessorService;

    public function __construct(MessageProcessorService $messageProcessorService)
    {
        $this->messageProcessorService = $messageProcessorService;
    }

    public function showForm(): Response
    {
        return $this->render('form.html.twig');
    }

    public function processForm(Request $request): Response
    {
        $message = $request->request->get('message');
        $wordsToMatch = explode(',', $request->request->get('wordsToMatch'));

        $wordsToMatch = array_map('trim', $wordsToMatch);

        $wordCounts = $this->messageProcessorService->countWords($message, $wordsToMatch);

        return $this->render('result.html.twig', [
            'message' => $message,
            'word_counts' => $wordCounts,
        ]);
    }
}