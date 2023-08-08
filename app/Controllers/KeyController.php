<?php

namespace App\Controllers;

use App\Auth\Auth;
use App\Models\ApiKey;
use App\Router\Abort;
use App\Router\Response;

class KeyController
{
    function __construct()
    {
        Auth::shouldBeAuthorized();
    }

    public function getKeys(){
        $apiKeys = Auth::$user->apiKeys;
        Response::json($apiKeys);
    }

    public function createKey(){
        $apiKey = ApiKey::create([
            'user_id' => Auth::$user->id,
            'api_key' => uniqid(Auth::$user->id.'_')
        ]);
        Response::json($apiKey);
    }

    public function deleteKey($keyId){
        $apiKey = ApiKey::where('api_key', $keyId)->get();
        if(count($apiKey) > 0){
            $apiKey[0]->delete();
            Response::json(['message' => 'Key deleted']);
        } else {
            Abort::badRequest('Key not found');
        }
    }
}