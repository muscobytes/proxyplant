<?php

namespace Muscobytes\Proxyplant;

use Muscobytes\Proxyplant\Exceptions\ProxyPlantException;
use Muscobytes\Proxyplant\Interfaces\ProxyProviderInterface;
use Muscobytes\Proxyplant\ProxyProviders\Configs\HidemynameConfig;
use Muscobytes\Proxyplant\ProxyProviders\Configs\RsocksConfig;
use Muscobytes\Proxyplant\ProxyProviders\HidemynameProvider;
use Muscobytes\Proxyplant\ProxyProviders\RsocksProvider;

class ProxyLoader
{
    protected array $providers = [];


    /**
     * @param array $config
     * @throws ProxyPlantException
     */
    public function __construct(array $config)
    {
        foreach ($config['providers'] as $providerName => $providerConfig) {
            $this->providers[$providerName] = $this->createProxyProvider($providerName, $providerConfig);
        }
    }


    /**
     * @param string $providerName
     * @param array $providerConfig
     * @return ProxyProviderInterface
     * @throws ProxyPlantException
     */
    public function createProxyProvider(string $providerName, array $providerConfig): ProxyProviderInterface
    {
        return match ($providerName) {
            'rsocks' => new RsocksProvider(new RsocksConfig($providerConfig)),
            'hidemyname' => new HidemynameProvider(new HidemynameConfig($providerConfig)),
            default => throw new ProxyPlantException("Proxy provider ${providerName} not found."),
        };
    }


    /**
     * @param string $providerName
     * @return mixed
     * @throws ProxyPlantException
     */
    public function getProvider(string $providerName): ProxyProviderInterface
    {
        if (!key_exists($providerName, $this->providers)) {
            throw new ProxyPlantException("Proxy provider ${providerName} not found.");
        }
        return $this->providers[$providerName];
    }


    /**
     * @return mixed
     */
    public function getRandomProvider()
    {
        return $this->providers[array_rand($this->providers)];
    }
}
