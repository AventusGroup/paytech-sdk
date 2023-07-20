<?php

namespace PayTech\PayTechBundle\Traits;

trait ValidationTrait
{
    public function defaultValidation(): array
    {
        $violations = [];
        $data = $this->toArray();

        $required = ['merchant', 'tranId', 'amount'];
        foreach ($data as $key => $value) {
            if (in_array($key, $required)) {
                if (empty($value)) {
                    $violations[$key] = 'Required property: ' . $key . 'is empty';
                }
            }
        }

        if (isset($data['token']) && isset($data['pan'])) {
            $violations['pan'] = 'Pan must be null if token exists';
        }

        return $violations;
    }
}
