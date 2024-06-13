<?php

namespace KatoSoftwareHouse\Service;

class Client implements ClientInterface
{
    protected mixed $message;

    public function __construct($message = '')
    {
        $this->message = $message;
    }

    public function run(): string
    {
        return 'works ' . $this->message;
    }
}
