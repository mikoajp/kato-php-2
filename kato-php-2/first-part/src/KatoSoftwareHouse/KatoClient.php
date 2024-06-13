<?php

namespace KatoSoftwareHouse;

use KatoSoftwareHouse\Service\AbstractClass;
use KatoSoftwareHouse\Service\Client;

class KatoClient extends AbstractClass
{
    public Client $client;

    public function __construct(Client $client = null)
    {
        $this->client = $client ?: new Client();
    }

    /**
     * @return string
     */
    function doSomething()
    {
        return $this->client->run();
    }
}
