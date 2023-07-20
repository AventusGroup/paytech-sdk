
# PayTechBundle

Bandle provides easy integration your system with PSP PayTechBundle

Minimal requirements:

php >=8.1\
symfony: >=6.0

# Installiation

```php
composer require paytech/paytech-bundle
```

After bundle is installed it will be autoregistered in 

```php
... config/bundles.php

return [
   .....
    PayTech\PayTechBundle\PayTechBundle::class => ['all' => true],
];
```

Final step of installation - adding vars to .env file or similar that used in your project

```php
PAYTECH_API_URL=http://processing.local/
PAYTECH_MERCHANT_KEY=1234567890
PAYTECH_MERCHANT_NAME=TestMerchant
```

After getting done with papers you'll be provided with PRODUCTION credentials


# Usage

Bundle provides you few methods based on your needs


```php
makeA2c(array data): PaytechResponseDto
makeC2a(array data): string
makeDirectC2a(array data): PaytechDirectResponseDto
makeLookUp(array data): string
makeDirectLookUp(array data): PaytechDirectResponseDto
makeVerification3ds(array data): string
makeDirectVerification3ds(array data): PaytechDirectResponseDto
makeCharge(array data): PaytechResponseDto
getStatus(array data): PaytechResponseDto
getBalance(array data): PaytechResponseDto
```

### !NB: Direct methods are avable ONLY for merchants with PCI DSS certificate.


