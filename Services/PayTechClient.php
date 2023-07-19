<?php

namespace PayTech\PayTechBundle\Services;

use GuzzleHttp\Client;

class PayTechClient
{
    public Client $client;

    public function __construct(private readonly string $host)
    {
        $this->client = new Client(['base_uri' => $this->host, 'verify' => false]);
    }
}