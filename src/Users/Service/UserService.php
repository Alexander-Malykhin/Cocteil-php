<?php

namespace Cocteil\Users\Service;

use Cocteil\Users\Repository;

class UserService implements UserServiceInterface
{
    public function __construct(private Repository\UserRepositoryInterface $repository)
    {
    }

    public function login(array $params): array
    {
        if (empty($params['email']) || empty($params['password']))
            throw new \ErrorException('Email и пароль обязательны');

        $user = $this->repository->getByEmail($params['email']);

        if (!$user)
            throw new \ErrorException('Пользователь не найден');

        if ($params['password'] !== $user['password'])
            throw new \ErrorException('Неверный логин или пароль');

        return $user;
    }

    public function registration(array $params): array
    {
        if (empty($params['email']) || empty($params['password']))
            throw new \ErrorException('Email и пароль обязательны');


        if ($this->repository->getByEmail($params['email']) !== null)
            throw new \ErrorException('Пользователь с таким email уже существует');

        return $this->repository->create([
            'email' => $params['email'],
            'password' => $params['password'],
        ]);
    }

    public function getAll(): array
    {
        return $this->repository->getAll();
    }
}