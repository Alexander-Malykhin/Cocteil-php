<?php
header('Access-Control-Allow-Origin: http://localhost:5173');
header('Access-Control-Allow-Headers: Content-Type, Authorization');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS')
{
    http_response_code(200);
    exit;
}

require dirname(__DIR__) . '/vendor/autoload.php';

use Cocteil\Router\Router;
use Cocteil\Controllers\AuthController;
use Cocteil\Controllers\UserController;

$router = new Router();
$authController = new AuthController();

$router->post('/backend/public/login', [$authController, 'login']);

$router->get('/backend/public/users', [new UserController(), 'index']);

$router->dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);