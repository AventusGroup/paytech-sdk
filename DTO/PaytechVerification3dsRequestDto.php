<?php

namespace PayTech\PayTechBundle\DTO;

use PayTech\PayTechBundle\Exceptions\ValidationException;
use PayTech\PayTechBundle\Services\SignService;
use PayTech\PayTechBundle\Traits\Arrayable;
use PayTech\PayTechBundle\Traits\ValidationTrait;
use Psr\Log\LoggerInterface;
use Symfony\Contracts\Service\Attribute\Required;

/**
 * @property ?string $merchant
 * @property ?string $tranId
 * @property ?string $token
 * @property ?string $payload
 * @property ?string $amount
 * @property ?string $lang
 * @property ?string $callback
 * @property ?string $type
 * @property ?string $description
 * @property ?string $successUrl
 * @property ?string $failUrl
 * @property ?string $percent_fee
 * @property  array{client_name: string, agreement_id: string, agreement_date:string,merchant: string,isExtension: string,isRestructure: string,pageTitle: string,buttonTitle: string,receipt_email: string} $options
 */
class PaytechVerification3dsRequestDto
{
    use ValidationTrait, Arrayable;

    public ?string $merchant;
    public ?string $tranId;
    public ?string $token;
    public ?string $payload;
    public ?string $amount;
    public ?string $lang;
    public ?string $callback;
    public ?string $type;
    public ?string $description;
    public ?string $successUrl;
    public ?string $failUrl;
    public ?string $percent_fee;
    public array $options;

    /**
     * @throws ValidationException
     */
    public function __construct(array $data)
    {
        $this->merchant = $data['merchant'] ?? null;
        $this->tranId = $data['tranId'] ?? null;
        $this->token = $data['token'] ?? null;
        $this->payload = $data['payload'] ?? null;
        $this->amount = $data['amount'] ?? null;
        $this->lang = $data['lang'] ?? null;
        $this->callback = $data['callback'] ?? null;
        $this->type = 'verification3ds';
        $this->description = $data['description'] ?? null;
        $this->successUrl = $data['successUrl'] ?? null;
        $this->failUrl = $data['failUrl'] ?? null;
        $this->percent_fee = $data['percent_fee'] ?? null;
        $this->options = [
            'client_name' => $data['options']['client_name'] ?? null,
            'agreement_id' => $data['options']['agreement_id'] ?? null,
            'agreement_date' => $data['options']['agreement_date'] ?? null,
            'merchant' => $data['options']['merchant'] ?? $data['merchant'],
            'isExtension' => $data['options']['isExtension'] ?? false,
            'isRestructure' => $data['options']['isRestructure'] ?? false,
            'pageTitle' => $data['options']['pageTitle'] ?? 'pay',
            'buttonTitle' => $data['options']['buttonTitle'] ?? 'pay',
            'receipt_email' => $data['options']['receipt_email'] ?? null,
        ];


        $this->validate();
    }

    /**
     * @return void
     * @throws ValidationException
     */
    private function validate(): void
    {
        $violations = $this->defaultValidation();

        if (empty($this->options['client_name'])) {
            $violations['client_name'] = 'Payer full - name are required';
        }

        if (count($violations) > 0) {
            throw new ValidationException('Validation exception', 422);
        }
    }
}
