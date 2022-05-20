<?php

namespace Muscobytes\Proxyplant\Interfaces;

use Muscobytes\Proxyplant\DTO\ProxyDTO;

interface ProxyplantInterface
{
    public function createProxyProvider(string $providerName, array $providerConfig): ProxyProviderInterface;

    public function getProvider(string $providerName): ProxyProviderInterface;

    public function getRandomProvider(): ProxyProviderInterface;

    public function getRandomProxy(): ProxyDTO;
}