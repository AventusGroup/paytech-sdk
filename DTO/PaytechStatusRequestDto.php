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
class PaytechStatusRequestDto
{
    use ValidationTrait, Arrayable;
    public string $merchant;
    public string $tranId;


    public function __construct(array $data)
    {
        $this->merchant = $data['merchant'] ?? null;
        $this->tranId = $data['tranId'] ?? null;
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
