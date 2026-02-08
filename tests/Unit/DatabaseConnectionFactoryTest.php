<?php

namespace Cocteil\Tests\Unit;

use Cocteil\Database\DatabaseConnectionFactory;
use PHPUnit\Framework\TestCase;
use RuntimeException;

final class DatabaseConnectionFactoryTest extends TestCase
{
    public function testUnsupportedDriverThrowsException(): void
    {
        $this->expectException(RuntimeException::class);

        DatabaseConnectionFactory::create('oracle', []);
    }
}
