<?php

namespace Muscobytes\Proxyplant\ProxyProviders;


use Muscobytes\Proxyplant\Interfaces\ProxyProviderInterface;
use Muscobytes\Proxyplant\Models\ProxyType;
use Muscobytes\Proxyplant\ProxyProviders\Configs\HidemynameConfig;
use Muscobytes\Proxyplant\DTO\ProxyDTO;


final class HidemynameProvider implements ProxyProviderInterface
{
    /**
     * @var HidemynameConfig $config
     */
    protected HidemynameConfig $config;


    /**
     * @param HidemynameConfig $config
     */
    public function __construct(HidemynameConfig $config)
    {
        $this->config = $config;
    }


    /**
     * load
     *
     * @return array
     */
    public function load(): array
    {
        return json_decode(file_get_contents( $this->config->url . '?' . http_build_query([
                'code' => $this->config->code,
                'out' => $this->config->out,
                'type' => $this->config->type,
                'anon' => $this->config->anon,
            ])));
    }


    /**
     * detectType
     *
     * @param object $proxy
     * @return int|mixed
     */
    protected function detectType(object $proxy)
    {
        $type = ProxyType::NONE;

        $map = [
            'http' => ProxyType::HTTP,
            'ssl' => ProxyType::SSL,
            'socks4' => ProxyType::SOCKS4,
            'socks5' => ProxyType::SOCKS5,
        ];

        foreach ($map as $propertyName => $proxyType) {
            if ((bool)$proxy->$propertyName) {
                $type = $proxyType;
            }
        }

        return $type;
    }


    /**
     * getRandomProxy
     *
     * @return ProxyDTO
     * @throws \Spatie\DataTransferObject\Exceptions\UnknownProperties
     */
    public function getRandomProxy(): ProxyDTO
    {
        $list = $this->load();
        $proxy = $list[array_rand($list)];
        return new ProxyDTO(
            host: $proxy->ip,
            port: $proxy->port,
            type: new ProxyType($this->detectType($proxy)),
        );
    }
}
