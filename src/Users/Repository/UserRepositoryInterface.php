<?php

namespace Cocteil\Users\Repository;

interface UserRepositoryInterface
{
    public function getAll(): array;

    public function getOne(int $id): array|null;

    public function getByEmail(string $email): array|null;

    public function create(array $params): array;

    public function delete(int $id): bool;

    public function update(int $id, array $params = []): bool;
}