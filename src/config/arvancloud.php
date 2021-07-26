<?php

return[
    'auth'=>[
        'default' =>'ApiKey',
        'UserToken'=>'',
        'ApiKey'=>'Apikey 2187d7f6-ecec-4309-8e35-37c3b0c92e69',
    ],

    'services'=>[
        'cdn'=>[
            'baseUrl'=>'https://napi.arvancloud.com/cdn/4.0/',
            'domain' => 'di-gi-mall.ir',
            'endpoints'=>[
                'domain'=>\Mohammadv184\ArvanCloud\Services\Cdn\Endpoints\Domain::class,
                'dns'=>\Mohammadv184\ArvanCloud\Services\Cdn\Endpoints\Dns::class,
            ]
        ]
    ],


    'map'=>[
        'cdn'=>\Mohammadv184\ArvanCloud\Services\Cdn\Cdn::class,
    ],
];