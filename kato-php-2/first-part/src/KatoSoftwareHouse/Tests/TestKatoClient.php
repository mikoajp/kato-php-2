<?php

namespace KatoSoftwareHouse\Tests;

use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\TestCase;
use KatoSoftwareHouse\KatoClient;
use KatoSoftwareHouse\Service\Client;

class TestKatoClient extends TestCase
{
    /**
     * @throws Exception
     */
    public function testExecute()
    {
        $clientMock = $this->createMock(Client::class);

        $clientMock->method('run')
            ->willReturn('works great');

        $katoClient = new KatoClient($clientMock);

        //do not change this assert
        $this->assertEquals($katoClient->doSomething(), 'works great');
    }

    /**
     * @throws Exception
     */
    public function testExecuteAgain()
    {
        $clientMock = $this->createMock(Client::class);

        $clientMock->method('run')
            ->willReturn('works fine');

        $katoClient = new KatoClient($clientMock);

        //do not change this assert
        $this->assertEquals($katoClient->doSomething(), 'works fine');
    }
}
