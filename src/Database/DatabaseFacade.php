<?php

namespace Cocteil\Database;

use Cocteil\Config\DatabaseConfig;
use PDO;

final class DatabaseFacade
{
    public static function connection(string $driver): PDO
    {
        $config = DatabaseConfig::get();

        if (!isset($config['connections'][$driver]))
            throw new \RuntimeException('Unknown DB driver: ' . $driver);

        $connection = $config['connections'][$driver];

        return DatabaseConnectionFactory::create(
            $connection['driver'],
            $connection
        );
    }
}
