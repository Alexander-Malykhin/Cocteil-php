<?php

namespace Cocteil\Users\Service;

interface UserServiceInterface
{
    public function registration(array $params): array;

    public function login(array $params): array;

    public function getAll(): array;
}