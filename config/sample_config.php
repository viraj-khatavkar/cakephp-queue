<?php

return [
    'cakephp_queue' => [
        'default' => 'beanstalkd',

        'beanstalkd' => [
            'connector' => 'beanstalkd',
            'host'      => '',
            'port'      => '',
            'queue'     => '',
        ],
    ],
];