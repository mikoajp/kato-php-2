<?php

namespace App\Tests;

use Symfony\Component\Panther\PantherTestCase;

class ApiControllerE2ETest extends PantherTestCase
{
    public function testProcessMessageValidInput()
    {
        $client = static::createClient();
        $client->request(
            'POST',
            '/api/process-message',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode(['message' => 'hello text hello'])
        );

        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $responseContent = json_decode($client->getResponse()->getContent(), true);

        $this->assertEquals('hello text hello', $responseContent['message']);
        $this->assertEquals(2, $responseContent['count']['hello']);
        $this->assertEquals(1, $responseContent['count']['text']);
    }

    public function testProcessMessageInvalidInput()
    {
        $client = static::createClient();
        $client->request(
            'POST',
            '/api/process-message',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode(['wrong_key' => 'hello world'])
        );

        $this->assertEquals(400, $client->getResponse()->getStatusCode());

        $responseContent = json_decode($client->getResponse()->getContent(), true);

        $this->assertEquals('Invalid request: "message" field is required', $responseContent['error']);
    }
}