<?php

namespace Cocteil\Controllers;

use Cocteil\Users\UserFactory;

class AuthController
{
    public function login(): void
    {
        try
        {
            $factory = new UserFactory('mysql');
            $service = $factory->create();

            $data = json_decode(file_get_contents('php://input'), true) ?? $_POST;

            $values = [
                'email' => $data['email'] ?? '',
                'password' => $data['password'] ?? '',
            ];

            $result = $service->login($values);

            http_response_code(200);
            echo json_encode([
                'status' => 'success',
                'data' => $result
            ]);
        }
        catch (\Throwable $e)
        {
            http_response_code(500);
            echo json_encode([
                'error' => $e->getMessage()
            ]);
        }
    }
}
