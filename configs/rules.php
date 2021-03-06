<?php

return [
    'max_file_size' => 5 * 1024 * 1024,
    'allowed_mime_types' => [
        'image/jpg',
        'image/jpeg',
        'image/png'
    ],
    'allowed_extensions' => [
        'jpg',
        'jpeg',
        'png'
    ],
    'password' => [
        'patterns' => [
            '~[A-Z]~',
            '~[a-z]~',
            '~[0-9]~',
        ],
        'min_length' => 6
    ]
];