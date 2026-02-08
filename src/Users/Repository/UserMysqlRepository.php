<?php

namespace Cocteil\Users\Repository;

use PDO;

class UserMysqlRepository implements UserRepositoryInterface
{
    public function __construct(private PDO $PDO)
    {
    }

    public function getAll(): array
    {
        return $this->PDO->query('SELECT * FROM users')->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getOne(int $id): array|null
    {
        $stmt = $this->PDO->prepare('SELECT * FROM users WHERE id = :id LIMIT 1');
        $stmt->execute(['id' => $id]);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        return $user ?: null;
    }

    public function getByEmail(string $email): array|null
    {
        $stmt = $this->PDO->prepare('SELECT * FROM users WHERE email = :email LIMIT 1');

        $stmt->execute(['email' => $email]);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        return $user ?: null;
    }

    public function create(array $params): array
    {
        $values = [
            'email' => $params['email'],
            'password' => $params['password'],
            'created_at' => (new \DateTime())->format('Y-m-d')
        ];

        $stmt = $this->PDO->prepare('INSERT INTO users (email, password,created_at) VALUES (:email, :password, :created_at)');

        $stmt->execute($values);

        $user = (int)$this->PDO->lastInsertId();

        return $this->getOne($user);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->PDO->prepare('DELETE FROM users WHERE id = :id LIMIT 1');
        return $stmt->execute(['id' => $id]);
    }

    public function update(int $id, array $params = []): bool
    {
        if (empty($params))
            return false;

        $fields = [];
        $values = ['id' => $id];

        if (isset($params['email'])) {
            $fields[] = 'email = :email';
            $values['email'] = $params['email'];
        }

        if (isset($params['password'])) {
            $fields[] = 'password = :password';
            $values['password'] = $params['password'];
        }

        $sql = sprintf('UPDATE users SET %s WHERE id = :id LIMIT 1', implode(', ', $fields));

        $stmt = $this->PDO->prepare($sql);

        return $stmt->execute($values);
    }
}