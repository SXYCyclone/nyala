<?php

return [
    /*
     *  Models that you want to be part of the webhooks options
     */
    'models' => [
        \App\Models\Role::class,
        \App\Models\Navigation::class,
    ],
    /*
     */
    'polling' => '10s',
    'webhook' => [
        'keep_history' => false,
    ],
];
