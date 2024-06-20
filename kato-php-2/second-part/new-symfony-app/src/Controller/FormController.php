<?php

namespace App\Controller;

use App\Service\MessageService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class FormController extends AbstractController
{
    private MessageService $messageService;

    public function __construct(MessageService $messageProcessorService)
    {
        $this->messageService = $messageProcessorService;
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

        $wordCounts = $this->messageService->countWords($message, $wordsToMatch);

        return $this->render('result.html.twig', [
            'message' => $message,
            'word_counts' => $wordCounts,
        ]);
    }
}