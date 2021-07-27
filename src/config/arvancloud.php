<?php

return[
    /*
    |--------------------------------------------------------------------------
    | Authentication Config
    |--------------------------------------------------------------------------
    |
    | These are the list of Authentication Config.
    |
    */
    'auth'=> [
        'default'  => 'ApiKey',
        'UserToken'=> '',
        'ApiKey'   => '',
    ],

    /*
    |--------------------------------------------------------------------------
    | List of Services
    |--------------------------------------------------------------------------
    |
    | These are the list of services to use for this package.
    | You can change the name. Then you'll have to change
    | it in the map array too.
    |
    */
    'services'=> [
        'cdn'=> [
            'baseUrl'  => 'https://napi.arvancloud.com/cdn/4.0/',
            'domain'   => 'your_domain.com',
            'endpoints'=> [
                'domain'=> \Mohammadv184\ArvanCloud\Services\Cdn\Endpoints\Domain::class,
                'dns'   => \Mohammadv184\ArvanCloud\Services\Cdn\Endpoints\Dns::class,
                'cache' => \Mohammadv184\ArvanCloud\Services\Cdn\Endpoints\Cache::class,
                'ssl'   => \Mohammadv184\ArvanCloud\Services\Cdn\Endpoints\Ssl::class,
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Class Maps
    |--------------------------------------------------------------------------
    |
    | This is the array of Classes that maps to Services above.
    | You can create your own Service if you like and add the
    | config in the Services array and the class to use for
    | here with the same name. You will have to extend
    | Mohammadv184\ArvanCloud\Services\API in your Service.
    |
    */
    'map'=> [
        'cdn'=> \Mohammadv184\ArvanCloud\Services\Cdn\Cdn::class,
    ],
];
