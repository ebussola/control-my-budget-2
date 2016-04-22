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
        ],
    ],
    'permission' => [
        'tab' => 'Control My Budget',
        'purchase' => 'Manage Purchases',
    ],
];