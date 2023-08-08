<?php

namespace App\Controllers;

use App\ApiKey\ApiKey;
use App\Router\Response;
use App\Models\FakeUser;
use App\Router\Abort;

class FakeUserController
{
    function __construct()
    {
        ApiKey::shouldHaveValidKey();
    }

    public function getFakeUsers(){
        Response::json(FakeUser::limit(20)->get());
    }

    public function getRandomFakeUser(){
        $fakeUsers = FakeUser::limit(20)->get();
        if(count($fakeUsers) > 0){
            $randomKey = random_int(0, count($fakeUsers) - 1);
            Response::json($fakeUsers[$randomKey]);
        }
        Abort::serverError('No fake user available');
    }
}