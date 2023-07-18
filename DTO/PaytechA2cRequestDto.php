<?php

namespace PayTech\PayTechBundle\DTO;

class PaytechA2cRequestDto
{
    public function __construct(array $data)
    {

    }


    public function toArray(): array
    {
        $result = [];
        foreach (get_class_vars(self::class) as $key => $var) {
            $result[$key] = $this->$var;
        }

        return $result;
    }
}