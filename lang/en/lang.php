<?php return [
    'plugin' => [
        'name' => 'Control My Budget',
        'description' => '',
    ],
    'model' => [
        'purchase' => [
            'date' => [
                'label' => 'Date',
            ],
            'place' => [
                'label' => 'Place',
            ],
            'amount' => [
                'label' => 'Amount',
            ],
            'label-plural' => 'Purchases',
            'created_at' => [
                'label' => 'Created at',
            ],
        ],
        'purchase-group' => [
            'name' => [
                'label' => 'Name',
            ],
            'users' => [
                'label' => 'Users',
            ],
        ],
    ],
    'permission' => [
        'tab' => 'Control My Budget',
        'purchase' => 'Manage Purchases',
        'purchase-group' => 'Manage Purchase groups',
    ],
    'purchase-group' => [
        'label' => [
            'plural' => 'Purchase Groups',
        ],
    ],
    'purchase' => [
        'purchase_group' => [
            'label' => 'Purchase Group',
        ],
    ],
];