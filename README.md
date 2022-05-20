# ProxyPlant

## Install

```shell
composer require muscobytes/proxyplant
```

## Usage

```php
use Muscobytes\Proxyplant\Proxyplant;

$providersConfig = [
    'hidemyname' => [
        'code' => getenv('HIDEMYNAME_CODE', '')
    ],
    'rsocks' => [
        'id' => getenv('RSOCKS_ID', ''),
        'key' => getenv('RSOCKS_KEY', ''),
    ]
];

$proxyplant = new Proxyplant($providersConfig);

/* @var $hidemyname \Muscobytes\Proxyplant\ProxyProviders\HidemynameProvider */
$hidemyname = $proxyplant->getProvider('hidemyname');

$proxy = $hidemyname->getRandomProxy($hidemyname->load());
```