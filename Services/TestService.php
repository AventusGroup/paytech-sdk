<?php

namespace PayTech\PayTechBundle\Services;

use Psr\Log\LoggerInterface;

class TestService
{
    public function __construct()
    {
    }

    public function test()
    {
        return [
            'message' => 'success'
        ];
    }
}