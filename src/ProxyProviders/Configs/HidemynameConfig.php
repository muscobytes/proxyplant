<?php

namespace Muscobytes\Proxyplant\ProxyProviders\Configs;

use Spatie\DataTransferObject\DataTransferObject;

class HidemynameConfig extends DataTransferObject
{
    public string $cache_key = 'proxy_provider_hidemyname';

    public int $cache_ttl = 3600;

    public string $url = 'https://hidemy.name/api/proxylist.txt';

    public string $code;

    public string $out = 'js';

    /**
     * @var string $type
     *
     * https://hidemy.name/en/proxy-list/
     *
     * For example, the type of proxy depends on how you will be able to use it. Here are the types:
     *
     * 'h' — HTTP: regular proxies that support HTTP requests. You can use them to view websites and download files
     *      over HTTP.
     * 's' — HTTPS: Also called SSL-enabled proxy servers. Allow you to view HTTPS sites. Using specialized programs,
     *      they can be used for any protocol, like SOCKS proxy servers.
     * '4' — Socks 4: Proxies that support the SOCKS protocol version 4. They can be used to connect over TCP / IP
     *      protocol to any address and port.
     * '5' — Socks 5: Includes all the features of version 4. Additional features include use of the UDP Protocol,
     *      the ability to make DNS requests through a proxy, and use of the BIND method to open the port for incoming
     *      connections.
     *
     * Concatenate values into a string to filter proxy types. Example: 'h4' will filter only Socks4 and HTTPS (SSL)
     * proxies.
     */
    public string $type = 'hs45';

    /**
     * @var string $anon
     *
     * https://hidemy.name/en/proxy-list/
     *
     * Proxy anonymity is a very important parameter. This determines whether your real address will be hidden and
     * whether or not the destination server will suspect that you're using a proxy.
     *
     * Anonymity categories that are in our proxy list:
     *
     * '1' — No anonymity: The remote server knows your IP address and knows that you are using a proxy.
     * '2' — Low anonymity: The remote server does not know your IP, but knows that you are using a proxy.
     * '3' — Average anonymity: The remote server knows that you are using a proxy and thinks that it knows your IP, but
     *      it is not yours (these are usually multi-network proxies that show the remote server the incoming interface
     *      as REMOTE_ADDR).
     * '4' — High anonymity: The remote server does not know your IP, and it has no direct evidence that you are using
     *      a proxy. These are anonymous proxies.
     */
    public string $anon = '1234';

}
