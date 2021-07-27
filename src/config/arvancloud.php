<?php

return[
    'auth'=>[
        'default' =>'ApiKey',
        'UserToken'=>'',
        'ApiKey'=>'',
    ],

    'services'=>[
        'cdn'=>[
            'baseUrl'=>'https://napi.arvancloud.com/cdn/4.0/',
            'domain' => 'your_domain.com',
            'endpoints'=>[
                'domain'=>\Mohammadv184\ArvanCloud\Services\Cdn\Endpoints\Domain::class,
                'dns'=>\Mohammadv184\ArvanCloud\Services\Cdn\Endpoints\Dns::class,
                'cache'=>\Mohammadv184\ArvanCloud\Services\Cdn\Endpoints\Cache::class,
                'ssl'=>\Mohammadv184\ArvanCloud\Services\Cdn\Endpoints\Ssl::class,
            ]
        ]
    ],


    'map'=>[
        'cdn'=>\Mohammadv184\ArvanCloud\Services\Cdn\Cdn::class,
    ],
];