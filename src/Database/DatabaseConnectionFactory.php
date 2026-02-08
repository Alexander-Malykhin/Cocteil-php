<?php

namespace Cocteil\Database;

use Cocteil\Database\Driver\MysqlDriver;
use Cocteil\Database\Driver\PgsqlDriver;
use PDO;
use RuntimeException;

final class DatabaseConnectionFactory
{
    public static function create(string $driver, array $config): PDO
    {
        $strategy = match ($driver) {
            'mysql' => new MysqlDriver(),
            'pgsql' => new PgsqlDriver(),
            default => throw new RuntimeException("Unsupported driver: $driver"),
        };

        return $strategy->connect($config);
    }
}
