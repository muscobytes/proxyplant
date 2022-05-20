<?php

namespace Muscobytes\Proxyplant\ProxyProviders;

use Muscobytes\Proxyplant\Exceptions\ProxyPlantException;
use Muscobytes\Proxyplant\Interfaces\ProxyProviderInterface;
use Muscobytes\ProxyPlant\Models\ProxyType;
use Muscobytes\Proxyplant\ProxyProviders\Configs\RsocksConfig;
use Muscobytes\Proxyplant\DTO\ProxyDTO;

class RsocksProvider implements ProxyProviderInterface
{
    /**
     * @var RsocksConfig $config
     */
    protected RsocksConfig $config;


    public function __construct(RsocksConfig $config)
    {
        $this->config = $config;
    }


    /**
     * load
     *
     * @return array
     * @throws ProxyPlantException
     */
    public function load(): array
    {
        $opts = [
            "http" => [
                "method" => "POST",
                "header" => "X-Auth-ID: " . $this->config->id . "\r\n"
                    . "X-Auth-Key: " . $this->config->key . "\r\n"
            ]
        ];

        // DOCS: https://www.php.net/manual/en/function.stream-context-create.php
        $context = stream_context_create($opts);

        // Open the file using the HTTP headers set above
        // DOCS: https://www.php.net/manual/en/function.file-get-contents.php
        $response = file_get_contents($this->config->api_endpoint, false, $context);
        $result = json_decode($response, true);
        if ($result['result'] === false) {
            if ($this->config->exception_on_empty_result) {
                throw new ProxyPlantException($result['error'], 100);
            }
        }
        return $result;
    }


    /**
     * detectType
     *
     * @param string $scheme
     * @return mixed
     */
    protected function detectType(string $scheme)
    {
        $map = [
            'http' => ProxyType::HTTP,
            'https' => ProxyType::SSL,
            'socks4' => ProxyType::SOCKS4,
            'socks5' => ProxyType::SOCKS5,
        ];

        return $map[$scheme];
    }


    /**
     * getRandomProxy
     * 
     * @return ProxyDTO
     * @throws ProxyPlantException
     * @throws \Spatie\DataTransferObject\Exceptions\UnknownProperties
     */
    public function getRandomProxy(array $list): ProxyDTO
    {
        $package = $list['packages'][array_rand($list['packages'])]['ips'];
        $url = parse_url($package[array_rand($package)]);
        return new ProxyDTO(
            type: new ProxyType($this->detectType($url['scheme'])),
            host: $url['host'],
            port: key_exists('port', $url) ? $url['port'] : '',
            username: key_exists('user', $url) ? $url['user'] : '',
            password: key_exists('pass', $url) ? $url['pass'] : '',
        );
    }
}
