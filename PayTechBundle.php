<?php

namespace PayTech\PayTechBundle;

use PayTech\PayTechBundle\DependencyInjection\PaytechExtension;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;


class PayTechBundle extends AbstractBundle
{
    protected string $extensionAlias = 'paytech_bundle';

    public function getPath(): string
    {
        return \dirname(__DIR__);

    }

    public function getContainerExtension(): ?ExtensionInterface
    {
        return new PaytechExtension();
    }
}