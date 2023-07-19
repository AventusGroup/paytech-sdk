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
 * @property string $pan
 * @property string $token
 * @property string $description
 * @property int $amount
 * @property string $operationType
 * @property array $options
 */
class PaytechBalanceRequestDto
{
    use ValidationTrait, Arrayable;
    public string $merchant;
    public string $tranId;
    public ?string $pan;
    public string $token;
    public string $description;
    public int $amount;
    public string $operationType;
    public array $options;
    private LoggerInterface $logger;

    /**
     * @throws ValidationException
     */
    public function __construct(array $data)
    {
        $this->merchant = $data['merchant'] ?? null;
        $this->tranId = $data['tranId'] ?? null;
        $this->pan = $data['pan'] ?? null;
        $this->token = $data['token'] ?? null;
        $this->description = $data['description'] ?? null;
        $this->amount = $data['amount'] ?? null;
        $this->operationType = 'a2c';
        $this->options = $data['options'] ?? null;

        $this->validate();
    }

    /**
     * @return void
     * @throws ValidationException
     */
    private function validate(): void
    {
        $violations = $this->defaultValidation();

        if (count($violations) > 0) {
            $this->logger->error('Validation not passed', $violations);
            throw new ValidationException('Validation exception', 422);
        }
    }

    #[Required]
    public function setLogger(LoggerInterface $logger): void
    {
        $this->logger = $logger;
    }
}
