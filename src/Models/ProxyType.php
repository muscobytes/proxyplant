<?php

namespace Muscobytes\Proxyplant\Models;

final class ProxyType
{
    public const NONE   = 0;
    public const HTTP   = 1;
    public const SSL    = 2;
    public const SOCKS4 = 4;
    public const SOCKS5 = 5;

    private static array $displayNames = [
        self::HTTP   => 'http',
        self::SSL    => 'ssl',
        self::SOCKS4 => 'socks4',
        self::SOCKS5 => 'socks5',
    ];

    public function __construct(
        private int $type
    ) {}

    public function __toString()
    {
        return self::$displayNames[$this->type];
    }

    public function __get($key)
    {
        return $this->$key;
    }
}
