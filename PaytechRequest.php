<?php

namespace PayTech\PayTechBundle;

use GuzzleHttp\Client;
use PayTech\PayTechBundle\DTO\PaytechA2cRequestDto;
use PayTech\PayTechBundle\DTO\PaytechResponseDto;
use Psr\Log\LoggerInterface;

class PaytechRequest
{
    public function __construct(
        private LoggerInterface $logger,
        private Client          $client
    ) {
    }

    public function makeA2c($data): PaytechResponseDto
    {
        $requestDto = new PaytechA2cRequestDto($data);
        $this->logger->info('PayTech outgoing request', $requestDto->toArray());

        $response = $this->client->post('/v1/a2c', ['json' => $requestDto->toArray()]);

        $responseDto = new PaytechResponseDto($response);
        $this->logger->info('PayTech response', $responseDto->toArray());

        return $responseDto;
    }

    public function makeC2a(): string
    {
        $this->logger->info('PayTech outgoing request', []);
        $this->logger->info('PayTech response', []);
    }

    public function makeCharge()
    {
        $this->logger->info('PayTech outgoing request', []);
        $this->logger->info('PayTech response', []);
    }

    public function getStatus()
    {
        $this->logger->info('PayTech outgoing request', []);
        $this->logger->info('PayTech response', []);
    }

    public function getBalance()
    {
        $this->logger->info('PayTech outgoing request', []);
        $this->logger->info('PayTech response', []);
    }

}