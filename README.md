<p align="center"><img src="resources/images/arvan-logo.svg" alt="ArvanCloud"></p>


# PHP ArvanCloud API


[![Latest Stable Version](http://poser.pugx.org/mohammadv184/arvancloud/v)](https://packagist.org/packages/mohammadv184/arvancloud)
[![Total Downloads](http://poser.pugx.org/mohammadv184/arvancloud/downloads)](https://packagist.org/packages/mohammadv184/arvancloud)
[![Latest Unstable Version](http://poser.pugx.org/mohammadv184/arvancloud/v/unstable)](https://packagist.org/packages/mohammadv184/arvancloud)
[![Build Status](https://www.travis-ci.com/mohammadv184/arvancloud.svg?branch=main)](https://www.travis-ci.com/mohammadv184/arvancloud)
[![License](http://poser.pugx.org/mohammadv184/arvancloud/license)](https://packagist.org/packages/mohammadv184/arvancloud)


PHP library for the ArvanCloud API.
This package supports `PHP 7.3+`.

For **Laravel** integration you can use [mohammadv184/arvancloud-laravel](https://github.com/mohammadv184/arvancloud-laravel) package.

# List of contents

- [PHP ArvanCloud API](#PHP-ArvanCloud-API)
- [List of contents](#list-of-contents)
- [List of services](#list-of-services)
    - [Install](#install)
    - [Configure](#configure)
    - [How to use service](#how-to-use-service)
        - [CDN](#CDN)
    - [Credits](#credits)
    - [License](#license)

# List of services
- [CDN](https://www.arvancloud.com/en/products/cdn) :heavy_check_mark:  
- [Vod](https://www.arvancloud.com/en/products/video-platform) :hourglass:
- [iaas](https://www.arvancloud.com/en/products/cloud-computing) :hourglass:
- [VAds](https://www.arvancloud.com/en/products/video-ads) :hourglass:

## Install

Via Composer

``` bash
composer require mohammadv184/arvancloud
```
## Configure

a. Copy `config/arvancloud.php` into somewhere in your project. (you can also find it in `vendor/mohammadv184/arvancloud/config/arvancloud.php` path).

b. In the config file you can set the Config to be used for all your Service and you can also change the Config at runtime.

Choose what Authentication type you would like to use in your application.

```php
    'auth'=> [
        'default'  => 'ApiKey', //Set default Auth Type
        'UserToken'=> '',
        'ApiKey'   => '',//User API Key available in arvancloud panel
    ],
    ...
```

Then fill the credentials for that Service in the services array.

```php
'services' => [
    'cdn' => [
        'baseUrl'  => 'https://napi.arvancloud.com/cdn/4.0/',
        'domain'   => 'your_domain.com',// Fill in the credentials here.
        'endpoints'=> [...],
    ],
    ...
]
    ...   
```

c. Instantiate the `ArvanCloud` class and **pass configs to it** like the below:

```php
    use Mohammadv184\ArvanCloud\ArvanCloud;

    // load the config file from your project
    $config = require('path/to/arvancloud.php');

    $arvanCloud= new ArvanCloud($config);
```

## How to use service

How to use ArvanCloud Services.

### CDN

before doing any thing you need ArvanCloud Class

In your code, use it like the below:

```php
// At the top of the file.
use Mohammadv184\ArvanCloud\ArvanCloud;
...

// Create new ArvanCloud.
$arvanCloud = new ArvanCloud($config);

// Using Cdn Service
$arvanCloud->cdn()->domain('your_domain.com')->get();

// more Example
// 1
$arvanCloud->cdn()->domain()->get('your_domain.com');
// 2 
$arvanCloud->cdn()->domain()->all();
// 3
$arvanCloud->cdn()->cache('your_domain.com')->purge();
// 4
$arvanCloud->cdn()->dns()->delete('Dns_id','your_domain.com')
                    ->getMessage();
```
Available methods:
- `domain` :
  - `all()` : get all domains
  - `create(string $domain)` : Create New Domain.
  - `get(string $domain = null)` : Get Domain Settings
  - `delete(string $domain = null)` : Delete Domain.
- `cache` : 
  - `get(string $domain = null)` : Get Domain Cache settings.
  - `update(array $data, string $domain = null)` : Update Domain Cache settings.
  - `purge(array $urls = null, string $domain = null)` : Purge Domain Cache.
- `dns` :
  - `all()` : Get All Domain Dns.
  - `create(string $domain)` : Create new Domain Dns.
  - `get(string $domain = null)` : Get Domain Dns Settings.
  - `update(string $id, array $data, string $domain = null)` : Update Domain Dns Settings.  
  - `delete(string $domain = null)` : Delete Domain Dns.
  - `cloud(string $id, bool $status = true, string $domain = null)` : Update Domain Dns Cloud Status.
  - `import($zoneFile, string $domain = null)` : Import DNS records using BIND file
- `ssl` :
  - `get(string $domain = null)` : Get Domain Ssl Settings.
  - `update(string $sslType, string $domain = null)` : Update Domain Ssl Settings.

## Credits

- [Mohammad Abbasi](https://github.com/mohammadv184)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.
