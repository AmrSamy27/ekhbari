<?php

return [
    /**
     * Control if the seeder should create a user per role while seeding the data.
     */
    'create_users' => false,

    /**
     * Control if all the laratrust tables should be truncated before running the seeder.
     */
    'truncate_tables' => true,

    'roles_structure' => [
        'super_admin' => [
            'users'       => 'c,r,u,d',
            'profile'     => 'r,u',
            'articles'    => 'c,r,u,d',
            'departments' => 'c,r,u,d',
            'logs'        => 'c,r,u,d',
            'writers'     =>'c,r,u,d'

        ],
        'admin' => [
            'users'       => 'c,r,u,d',
            'profile'     => 'r,u',
            'articles'    => 'c,r,u,d',
            'departments' => 'c,r,u,d',
            'logs'        => 'c,r,u,d',
            'writers'     =>'c,r,u,d'

        ],
        'editor' => [
            'articles'    => 'c,r,u,d',
            'profile'     => 'r,u',
            'departments' => 'c,r,u,d',
            'writers'     =>'c,r'
        ],
        'writer' => [
            'articles' => 'c,r',
            'profile' => 'r,u',
            'departments' => 'r',

        ],
        'user' => [
            'articles' => 'r',
            'profile' => 'r,u',
            'departments' => 'r',

        ],
        
    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];
