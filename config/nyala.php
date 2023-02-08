<?php

return [
    'company' => [
        'allow_personal_company_invites' => false,
        'allow_personal_company_rename' => false,
    ],

    'role' => [
        'permissions' => [
            'navigation:manage' => 'Ability to manage custom navigation items.',
            'company:manage' => 'Ability to manage companies information.',
            'employee:manage' => 'Ability to manage companies\' employees.',
        ],

        'presets' => [
            'custom' => [
                'name' => 'Custom',
                'description' => 'Custom roles can be created and managed.',
                'permissions' => [],
            ],

            'admin' => [
                'name' => 'Administrator',
                'description' => 'Administrator users can perform any action.',
                'permissions' => [
                    'navigation:manage',
                    'company:manage',
                    'employee:manage',
                ],
            ],

            'editor' => [
                'name' => 'Editor',
                'description' => 'Editor users can read, create, and update resources.',
                'permissions' => [],
            ],

            'viewer' => [
                'name' => 'Viewer',
                'description' => 'Viewer users can only read resources.',
                'permissions' => [],
            ],
        ],
    ],
];
