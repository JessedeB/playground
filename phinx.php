<?php
return [
    'paths' => [
        'migrations' => 'database/migrations'
    ],
    'migration_base_class' => '\app\Migration\Migration',
    'environments' => [
        'default_migration_table' => 'migrations',
        'default_database' => 'dev',
        'dev' => [
            'adapter' => 'mysql',
            'host' => '127.0.0.1',
            'name' => 'testdb',
            'user' => 'root',
            'pass' => '',
            'port' => 3306
        ]
    ]
];
