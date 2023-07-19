<?php

namespace PayTech\PayTechBundle\DTO;

use GuzzleHttp\Psr7\Request;
use PayTech\PayTechBundle\Traits\Arrayable;
use Psr\Http\Message\ResponseInterface;

/**
 * @property ?int $responseCode
 * @property ?int $createDate
 * @property ?int $callbackDate
 * @property ?string $approval
 * @property ?string $description
 * @property ?string $pan
 * @property ?string $gatewayName
 * @property ?string $tranId
 * @property ?string $respMessage
 * @property ?string $token
 */
class PaytechResponseDto
{
    use Arrayable;

    public const SUCCESS = [1000, 1200, 1210];
    public ?int $responseCode;
    public ?string $createDate;
    public ?string $callbackDate;
    public ?string $approval;
    public ?string $description;
    private ?int $amount;
    private ?int $fee;
    public ?string $pan;
    public ?string $gatewayName;
    public ?string $tranId;
    public ?string $respMessage;
    public ?string $token;
    public ?string $frameUrl;
    private ?int $deposit;

    /**
     * @param Request $request
     */
    public function __construct(ResponseInterface $response)
    {
        $data = json_decode($response->getBody()->getContents());

        $this->responseCode = (int)$data->respCode ?? null;
        $this->createDate = $data->createDate ?? null;
        $this->callbackDate = $data->callbackDate ?? null;
        $this->approval = $data->approval ?? null;
        $this->description = $data->description ?? null;
        $this->amount = $data->amount ?? null;
        $this->fee = $data->fee ?? null;
        $this->pan = $data->pan ?? null;
        $this->gatewayName = $data->gatewayName ?? null;
        $this->tranId = $data->tranId ?? null;
        $this->respMessage = $data->respMessage ?? null;
        $this->token = $data->token ?? null;
        $this->frameUrl = $data->frameUrl ?? null;
        $this->deposit = $data->deposit ?? null;
    }

    /**
     * Method can return a float value or in integer
     * By default every action with money process in coin dimension
     * Example $amount = 100 means 1UAH
     * @param bool $raw
     * @return float
     */
    public function getAmount(bool $raw = false): float
    {
        if (!$this->amount) {
            return 0.0;
        }
        if ($raw) {
            return $this->amount;
        }
        return $this->amount / 100;
    }

    /**
     * Method can return a float value or in integer
     * By default every action with money process in coin dimension
     * Example $fee = 100 means 1UAH
     * @param bool $raw
     * @return float
     */
    public function getFee(bool $raw = false): float
    {
        if (($this->fee <= 0) || !$this->fee) {
            return 0.0;
        }

        if ($raw) {
            return $this->fee;
        }
        return $this->fee / 100;
    }

    public function isSuccess(): bool
    {
        return in_array($this->responseCode, self::SUCCESS, true);
    }

    public function getBalance(bool $raw = false): float
    {
        if (($this->deposit <= 0) || !$this->deposit) {
            return 0.0;
        }

        if ($raw) {
            return $this->deposit;
        }
        return $this->deposit / 100;
    }
}