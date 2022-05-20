<?php

namespace Muscobytes\Proxyplant\ProxyProviders\Configs;

use Spatie\DataTransferObject\DataTransferObject;

final class RsocksConfig extends DataTransferObject
{
    public string $api_endpoint = 'https://rsocks.net/api/v1/file/get-proxy';

    public string $id;

    public string $key;

    public bool $exception_on_empty_result = false;
}
