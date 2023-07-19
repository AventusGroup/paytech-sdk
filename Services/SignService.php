<?php

namespace PayTech\PayTechBundle\Services;

class SignService
{
    public function __construct(
        readonly private string $secretKey
    ) {
    }

    public function signRequest(array $request, string $secretKey = null): array
    {
        if (!$secretKey){
            $secretKey = $this->secretKey;
        }
        $baseEncoded = base64_encode(json_encode($request));
        $signString = $secretKey . $baseEncoded . $secretKey;
        $signature = base64_encode(sha1($signString));

        $request['sign'] = $signature;
        return $request;
    }

    public function checkSign(array $request, string $secretKey = null): bool
    {
        if (!$secretKey){
            $secretKey = $this->secretKey;
        }
    }

    public function makePayload()
    {

    }
}
