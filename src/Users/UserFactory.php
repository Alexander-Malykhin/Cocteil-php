<?php

namespace Cocteil\Users;

use Cocteil\Database\DatabaseFacade;
use Cocteil\Users\Repository\UserMysqlRepository;
use Cocteil\Users\Service\UserService;
use Cocteil\Users\Service\UserServiceInterface;

final class UserFactory
{
    private string $driver;

    public function __construct(string $driver)
    {
        $this->driver = $driver;
    }

    public function create(): UserServiceInterface
    {
        $pdo = DatabaseFacade::connection($this->driver);

        return match ($this->driver) {
            'mysql' => new UserService(
                new UserMysqlRepository($pdo)
            ),
            default => throw new \RuntimeException(
                'Unsupported user driver: ' . $this->driver
            ),
        };
    }
}
