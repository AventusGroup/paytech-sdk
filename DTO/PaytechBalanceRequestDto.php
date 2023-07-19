<?php

namespace PayTech\PayTechBundle\DTO;

use PayTech\PayTechBundle\Exceptions\ValidationException;
use PayTech\PayTechBundle\Services\SignService;
use PayTech\PayTechBundle\Traits\Arrayable;
use PayTech\PayTechBundle\Traits\ValidationTrait;
use Psr\Log\LoggerInterface;
use Symfony\Contracts\Service\Attribute\Required;

/**
 * @property string $merchant
 * @property string $tranId
 */
class PaytechBalanceRequestDto
{
    use ValidationTrait, Arrayable;

    public string $merchant;
    public string $tranId;

    private SignService $signService;

    public function __construct(array $data)
    {
        $this->merchant = $data['merchant'] ?? null;
        $this->tranId = 'balance_request' . time();
    }

    public function getSignedData(): array
    {
        return $this->signService->signRequest($this->toArray());
    }

    #[Required]
    public function setSignService(SignService $signService)
    {
        $this->signService = $signService;
    }
}
