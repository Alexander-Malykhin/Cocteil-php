<?php

namespace Cocteil\Controllers;

use Cocteil\Users\UserFactory;

class UserController
{
    public function index(): void
    {
        try {
            $factory = new UserFactory('mysql');
            $service = $factory->create();

            $users = $service->getAll();

            echo json_encode($users);
        } catch (\Throwable $e) {
            http_response_code(500);
            echo json_encode([
                'error' => $e->getMessage()
            ]);
        }
    }
}
