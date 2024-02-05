<?php

return [
    'role_structure' => [
        'superadmin' => [
            'users' => 'c,r,u,d',
            'acl' => 'c,r,u,d',
            'profile' => 'r,u'
        ],
        'administrator' => [
            'users' => 'c,r,u,d',
            'profile' => 'r,u'
        ],
        'coordinator' => [
            'profile' => 'r,u'
        ],
        'student' => [
            'profile' => 'r,u'
        ],
        'sponsor' => [
            'profile' => 'r,u'
        ]
    ],
    'permission_structure' => [],
    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];
