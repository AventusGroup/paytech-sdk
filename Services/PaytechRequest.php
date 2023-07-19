<?php

namespace PayTech\PayTechBundle\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Response;
use PayTech\PayTechBundle\DTO\PaytechA2cRequestDto;
use PayTech\PayTechBundle\DTO\PaytechC2aRequestDto;
use PayTech\PayTechBundle\DTO\PaytechChargeRequestDto;
use PayTech\PayTechBundle\DTO\PaytechResponseDto;
use PayTech\PayTechBundle\Exceptions\ValidationException;
use Psr\Log\LoggerInterface;

class PaytechRequest
{
    public function __construct(
        private readonly LoggerInterface $logger,
        private readonly Client          $client
    ) {
    }

    /**
     * @throws ValidationException
     */
    public function makeA2c($data): PaytechResponseDto
    {
        $requestDto = new PaytechA2cRequestDto($data);
        $this->logger->info('PayTech outgoing request', $requestDto->toArray());
        $response = new Response();

        try {
            $response = $this->client->post('/v1/a2c', ['json' => $requestDto->toArray()]);
        } catch (\Throwable $exception) {
            $this->logger->error($exception->getMessage(), $exception->getTrace());
        }

        $responseDto = new PaytechResponseDto($response);
        $this->logger->info('PayTech response', $responseDto->toArray());

        return $responseDto;
    }

    /**
     * @throws ValidationException
     */
    public function makeC2a($data): string
    {
        $requestDto = new PaytechC2aRequestDto($data);
        $this->logger->info('PayTech outgoing request', $requestDto->toArray());
        $response = new Response();

        try {
            $response = $this->client->post('/url/frame/c2a', ['json' => $requestDto->toArray()]);
        } catch (\Throwable $exception) {
            $this->logger->error($exception->getMessage(), $exception->getTrace());
        }

        $responseDto = new PaytechResponseDto($response);
        $this->logger->info('PayTech response', $responseDto->toArray());

        return $responseDto->frameUrl;
    }

    /**
     * @throws ValidationException
     */
    public function makeCharge($data): PaytechResponseDto
    {
        $requestDto = new PaytechChargeRequestDto($data);
        $this->logger->info('PayTech outgoing request', $requestDto->toArray());
        $response = new Response();

        try {
            $response = $this->client->post('/v1/charge', ['json' => $requestDto->toArray()]);
        } catch (\Throwable $exception) {
            $this->logger->error($exception->getMessage(), $exception->getTrace());
        }

        $responseDto = new PaytechResponseDto($response);
        $this->logger->info('PayTech response', $responseDto->toArray());

        return $responseDto;
    }

    public function getStatus($data)
    {
        $this->logger->info('PayTech outgoing request', []);
        $this->logger->info('PayTech response', []);
    }

    public function getBalance($data)
    {
        $this->logger->info('PayTech outgoing request', []);
        $this->logger->info('PayTech response', []);
    }

}