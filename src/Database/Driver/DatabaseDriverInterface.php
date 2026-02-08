<?php

namespace Cocteil\Database\Driver;

use PDO;

interface DatabaseDriverInterface
{
    public function connect(array $config): PDO;
}
