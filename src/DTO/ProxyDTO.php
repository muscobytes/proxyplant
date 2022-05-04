<?php

namespace Muscobytes\Proxyplant\DTO;

use Muscobytes\Proxyplant\Models\ProxyType;
use Spatie\DataTransferObject\DataTransferObject;


class ProxyDTO extends DataTransferObject
{
    public ProxyType $type;

    public string $host = '';

    #[NumberBetween(1, 65535)]
    public int $port = 80;

    public string $username = '';

    public string $password = '';

}
