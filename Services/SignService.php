<?php

namespace PayTech\PayTechBundle\Services;

class SignService
{
    public function signRequest(array $request, string $secretKey): array
    {
        $baseEncoded = base64_encode(json_encode($request));
        $signString = $secretKey . $baseEncoded . $secretKey;
        $signature = base64_encode(sha1($signString));

        $request['sign'] = $signature;
        return $request;
    }

    public function checkSign()
    {

    }

    public function makePayload()
    {

    }
}
