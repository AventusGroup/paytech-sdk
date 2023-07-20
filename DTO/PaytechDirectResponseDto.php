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
class PaytechDirectResponseDto
{
    use Arrayable;

    public const CODES = [
        1000 => 'OK',
        999 => 'NEED_3DS',
        998 => 'NEED_LOOKUP',
        888 => 'INTERNAL_ERROR',
        887 => 'SESSION_CLOSED',
    ];

    public $url;
    public $creq;
    public $pareq;
    public $code;


    /**
     * @param Request $request
     */
    public function __construct(ResponseInterface $response)
    {

        $data = json_decode($response->getBody()->getContents(), true);
        dd($response->getBody()->getContents());
        $this->url = $data['url'] ?? null;
        $this->creq = $data['creq'] ?? null;
        $this->pareq = $data['pareq'] ?? null;
        $this->code = $data['code'] ?? null;
    }
}