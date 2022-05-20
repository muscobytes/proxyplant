<?php

namespace Muscobytes\Proxyplant\Interfaces;

use Muscobytes\Proxyplant\DTO\ProxyDTO;

interface ProxyProviderInterface
{
    public function load(): array;
    public function getRandomProxy(array $list): ProxyDTO;
}
