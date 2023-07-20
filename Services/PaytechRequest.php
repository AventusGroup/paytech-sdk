<?php

namespace PayTech\PayTechBundle\Services;

use GuzzleHttp\Psr7\Response;
use PayTech\PayTechBundle\DTO\PaytechA2cRequestDto;
use PayTech\PayTechBundle\DTO\PaytechBalanceRequestDto;
use PayTech\PayTechBundle\DTO\PaytechC2aRequestDto;
use PayTech\PayTechBundle\DTO\PaytechChargeRequestDto;
use PayTech\PayTechBundle\DTO\PaytechLookUpRequestDto;
use PayTech\PayTechBundle\DTO\PaytechResponseDto;
use PayTech\PayTechBundle\DTO\PaytechStatusRequestDto;
use PayTech\PayTechBundle\DTO\PaytechVerification3dsRequestDto;
use PayTech\PayTechBundle\Exceptions\ValidationException;
use Psr\Log\LoggerInterface;

class PaytechRequest
{
    public function __construct(
        private readonly LoggerInterface $logger,
        private readonly PayTechClient   $client,
        private readonly SignService     $signService,
    ) {
    }

    /**
     * @throws ValidationException
     */
    public function makeA2c($data): PaytechResponseDto
    {
        $requestDto = new PaytechA2cRequestDto($data);
        $signedData = $this->signService->signRequest($requestDto->toArray());
        $this->logger->info('PayTech outgoing request', $signedData);
        $response = new Response();

        try {
            $response = $this->client->client->post('/v1/a2c', ['json' => $signedData]);
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
        $signedData = $this->signService->signRequest($requestDto->toArray());
        $this->logger->info('PayTech outgoing request', $signedData);
        $response = new Response();

        try {
            $response = $this->client->client->post('/url/frame/c2a', ['json' => $signedData]);
        } catch (\Throwable $exception) {
            $this->logger->error($exception->getMessage(), $exception->getTrace());
        }

        $responseDto = new PaytechResponseDto($response);
        $this->logger->info('PayTech response', $responseDto->toArray());

        return $responseDto->frameUrl;
    }
    public function makeDirectC2a($data): string
    {
        $requestDto = new PaytechC2aRequestDto($data);
        $signedData = $this->signService->signRequest($requestDto->toArray());
        $this->logger->info('PayTech outgoing request', $signedData);
        $response = new Response();

        try {
            $response = $this->client->client->post('/url/frame/c2a', ['json' => $signedData]);
        } catch (\Throwable $exception) {
            $this->logger->error($exception->getMessage(), $exception->getTrace());
        }

        $responseDto = new PaytechResponseDto($response);
        $this->logger->info('PayTech response', $responseDto->toArray());

        return $responseDto->frameUrl;
    }
    public function makeLookUp($data): string
    {
        $requestDto = new PaytechLookUpRequestDto($data);
        $signedData = $this->signService->signRequest($requestDto->toArray());
        $this->logger->info('PayTech outgoing request', $signedData);
        $response = new Response();

        try {
            $response = $this->client->client->post('/url/frame/lookup', ['json' => $signedData]);
        } catch (\Throwable $exception) {
            $this->logger->error($exception->getMessage(), $exception->getTrace());
        }

        $responseDto = new PaytechResponseDto($response);
        $this->logger->info('PayTech response', $responseDto->toArray());

        return $responseDto->frameUrl;
    }
    public function makeDirectLookUp($data): string
    {
        $requestDto = new PaytechLookUpRequestDto($data);
        $signedData = $this->signService->signRequest($requestDto->toArray());
        $this->logger->info('PayTech outgoing request', $signedData);
        $response = new Response();

        try {
            $response = $this->client->client->post('/v1/lookup', ['json' => $signedData]);
        } catch (\Throwable $exception) {
            $this->logger->error($exception->getMessage(), $exception->getTrace());
        }

        $responseDto = new PaytechResponseDto($response);
        $this->logger->info('PayTech response', $responseDto->toArray());

        return $responseDto->frameUrl;
    }
    public function makeVerification3ds($data): string
    {
        $requestDto = new PaytechVerification3dsRequestDto($data);
        $signedData = $this->signService->signRequest($requestDto->toArray());
        $this->logger->info('PayTech outgoing request', $signedData);
        $response = new Response();

        try {
            $response = $this->client->client->post('/url/frame/verification3ds', ['json' => $signedData]);
        } catch (\Throwable $exception) {
            $this->logger->error($exception->getMessage(), $exception->getTrace());
        }

        $responseDto = new PaytechResponseDto($response);
        $this->logger->info('PayTech response', $responseDto->toArray());

        return $responseDto->frameUrl;
    }
    public function makeDirectVerification3ds($data): string
    {
        $requestDto = new PaytechVerification3dsRequestDto($data);
        $signedData = $this->signService->signRequest($requestDto->toArray());
        $this->logger->info('PayTech outgoing request', $signedData);
        $response = new Response();

        try {
            $response = $this->client->client->post('/v1/verification3ds', ['json' => $signedData]);
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
        $signedData = $this->signService->signRequest($requestDto->toArray());
        $this->logger->info('PayTech outgoing request', $signedData);
        $response = new Response();

        try {
            $response = $this->client->client->post('/v1/charge', ['json' => $signedData]);
        } catch (\Throwable $exception) {
            $this->logger->error($exception->getMessage(), $exception->getTrace());
        }

        $responseDto = new PaytechResponseDto($response);
        $this->logger->info('PayTech response', $responseDto->toArray());

        return $responseDto;
    }
    public function getStatus($data): PaytechResponseDto
    {
        $requestDto = new PaytechStatusRequestDto($data);
        $signedData = $this->signService->signRequest($requestDto->toArray());
        $this->logger->info('PayTech outgoing request', $signedData);
        $response = new Response();

        try {
            $response = $this->client->client->post('/v1/status', ['json' => $signedData]);
        } catch (\Throwable $exception) {
            $this->logger->error($exception->getMessage(), $exception->getTrace());
        }

        $responseDto = new PaytechResponseDto($response);
        $this->logger->info('PayTech response', $responseDto->toArray());

        return $responseDto;
    }
    public function getBalance($data): PaytechResponseDto
    {
        $requestDto = new PaytechBalanceRequestDto($data);
        $signedData = $this->signService->signRequest($requestDto->toArray());
        $this->logger->info('PayTech outgoing request', $signedData);
        $response = new Response();

        try {
            $response = $this->client->client->post('/v1/getDeposit', ['json' => $signedData]);
        } catch (\Throwable $exception) {
            $this->logger->error($exception->getMessage(), $exception->getTrace());
        }

        $responseDto = new PaytechResponseDto($response);
        $this->logger->info('PayTech response', $responseDto->toArray());

        return $responseDto;
    }
}