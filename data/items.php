<?php
return [
    'create' => [
        'type' => 2,
        'description' => 'create post',
    ],
    'update' => [
        'type' => 2,
        'description' => 'update post',
    ],
    'delete' => [
        'type' => 2,
        'description' => 'delete',
    ],
    'adminCan' => [
        'type' => 2,
        'description' => 'adminCan',
    ],
    'updateOwn' => [
        'type' => 2,
        'description' => 'Update own post',
        'ruleName' => 'isAuthor',
        'children' => [
            'update',
        ],
    ],
    'user' => [
        'type' => 1,
        'ruleName' => 'userGroup',
        'children' => [
            'create',
            'updateOwn',
        ],
    ],
    'admin' => [
        'type' => 1,
        'ruleName' => 'userGroup',
        'children' => [
            'update',
            'delete',
            'adminCan',
            'user',
        ],
    ],
];
