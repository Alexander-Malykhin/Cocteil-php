<?php

require dirname(__DIR__) . '/vendor/autoload.php';

use Cocteil\Router\Router;
use Cocteil\Controllers\AuthController;
use Cocteil\Controllers\UserController;

$router = new Router();
$authController = new AuthController();

$router->post('/backend/public/login', [$authController, 'login']);

$router->get('/backend/public/users', [new UserController(), 'index']);

$router->dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);