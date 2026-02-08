<?php

namespace Cocteil\Config;

final class DatabaseConfig
{
    public static function get(): array
    {
        return [
            'default' => 'mysql',

            'connections' => [
                'mysql' => [
                    'driver'   => 'mysql',
                    'host'     => 'MySQL-8.4',
                    'port'     => 3306,
                    'database' => 'cocteil',
                    'username' => 'root',
                    'password' => '',
                    'charset'  => 'utf8mb4',
                ],

                'pgsql' => [
                    'driver'   => 'pgsql',
                    'host'     => 'MySQL-8.4',
                    'port'     => 5432,
                    'database' => 'cocteil',
                    'username' => 'root',
                    'password' => '',
                ],
            ],
        ];
    }
}
