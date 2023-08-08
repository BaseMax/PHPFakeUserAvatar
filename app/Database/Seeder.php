<?php

use Dotenv\Dotenv;
use App\Database\Database;
use App\Models\FakeUser;
use App\Models\User;

require_once '../../vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__.'/../..');
$dotenv->load();
Database::init();


User::create([
    'name' => 'mohammad',
    'email' => 'mohammad@joubeh.com',
    'password' => password_hash('123456', PASSWORD_DEFAULT)
]);

$faker = Faker\Factory::create();
for($i=0; $i<20; $i++){
    FakeUser::create([
        'first_name' => $faker->firstName(),
        'last_name' => $faker->lastName(),
        'email' => $faker->email(),
        'avatar_url' => $faker->imageUrl(360, 360, 'person', true)
    ]);
}

