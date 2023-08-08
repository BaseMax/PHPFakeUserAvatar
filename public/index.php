<?php

use App\Router\Router;
use App\Router\Abort;
use App\Controllers\AuthController;
use App\Controllers\KeyController;
use App\Controllers\FakeUserController;
use Dotenv\Dotenv;
use App\Database\Database;

require_once '../vendor/autoload.php';


$dotenv = Dotenv::createImmutable(__DIR__.'/..');
$dotenv->load();
Database::init();

Router::post('/api/login', [AuthController::class, 'login']);
Router::post('/api/register', [AuthController::class, 'register']);

Router::get('/api/get-keys', [KeyController::class, 'getKeys']);
Router::post('/api/create-key', [KeyController::class, 'createKey']);
Router::delete('/api/delete-key/:keyId', [KeyController::class, 'deleteKey']);

Router::get('/api/get-fake-users', [FakeUserController::class, 'getFakeUsers']);
Router::get('/api/get-random-fake-user', [FakeUserController::class, 'getRandomFakeUser']);


Abort::notFound();