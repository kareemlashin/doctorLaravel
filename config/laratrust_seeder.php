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
        'owner' => [
            'administrator' => 'c,r,u,d',
            'subAdmin' => 'c,r,u,d',
            'doctor' => 'c,r,u,d',
            'patient' => 'c,r,u,d',
            'gender' => 'c,r,u,d',
            'post' => 'c,r,u,d',
            'Experience' => 'c,r,u,d',
            'Skills' => 'c,r,u,d',
            'team' => 'c,r,u,d',
            'nurse' => 'c,r,u,d',
            'review' => 'c,r,u,d',
            'rating' => 'c,r,u,d',
            'degree' => 'c,r,u,d',
            'location' => 'c,r,u,d',
            'timeTable' => 'c,r,u,d',
            'payment' => 'c,r,u,d',
            'Discount_code' => 'c,r,u,d',
            'specialties' => 'c,r,u,d',
            'titles' => 'c,r,u,d',
            'clinic' => 'c,r,u,d',
        ],
        'administrator' => [
            'subAdmin' => 'c,r,u,d',
            'doctor' => 'c,r,u,d',
            'patient' => 'c,r,u,d',
            'gender' => 'c,r,u,d',
            'post' => 'c,r,u,d',
            'Experience' => 'c,r,u,d',
            'Skills' => 'c,r,u,d',
            'team' => 'c,r,u,d',
            'nurse' => 'c,r,u,d',
            'review' => 'c,r,u,d',
            'rating' => 'c,r,u,d',
            'degree' => 'c,r,u,d',
            'location' => 'c,r,u,d',
            'timeTable' => 'c,r,u,d',
            'payment' => 'c,r,u,d',
            'Discount_code' => 'c,r,u,d',
            'specialties' => 'c,r,u,d',
            'titles' => 'c,r,u,d',
            'clinic' => 'c,r,u,d',
        ],
        'subAdmin' => [
            'doctor' => 'c,r,u,d',
            'patient' => 'c,r,u,d',
            'gender' => 'c,r,u,d',
            'post' => 'c,r,u,d',
            'Experience' => 'c,r,u,d',
            'Skills' => 'c,r,u,d',
            'team' => 'c,r,u,d',
            'nurse' => 'c,r,u,d',
            'review' => 'c,r,u,d',
            'rating' => 'c,r,u,d',
            'degree' => 'c,r,u,d',
            'location' => 'c,r,u,d',
            'timeTable' => 'c,r,u,d',
            'payment' => 'c,r,u,d',
            'Discount_code' => 'c,r,u,d',
            'specialties' => 'c,r,u,d',
            'titles' => 'c,r,u,d',
            'clinic' => 'c,r,u,d',
        ],
        'doctor' => [
            'profile' => 'c,r,u,d'
        ],
        'patient' => [
            'profile' => 'c,r,u,d'
        ],
        'guest' => [
            'show' => 'r',
        ]
    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];
