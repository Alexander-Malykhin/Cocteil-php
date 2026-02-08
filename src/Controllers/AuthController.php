<?php

namespace Cocteil\Controllers;

use Cocteil\Users\UserFactory;

class AuthController
{
    public function login(): void
    {
        try {
            $factory = new UserFactory('mysql');
            $service = $factory->create();

            $result = $service->login([
                'email' => $_POST['email'] ?? '',
                'password' => $_POST['password'] ?? '',
            ]);

            echo json_encode([
                'status' => 'success',
                'data' => $result
            ]);
        } catch (\Throwable $e) {
            http_response_code(500);
            echo json_encode([
                'error' => $e->getMessage()
            ]);
        }
    }
}
