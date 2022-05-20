<?php

namespace Muscobytes\Proxyplant\Interfaces;

interface ProxyplantInterface
{
    public function createProxyProvider(string $providerName, array $providerConfig): ProxyProviderInterface;

    public function getProvider(string $providerName): ProxyProviderInterface;

    public function getRandomProvider(): ProxyProviderInterface;
}