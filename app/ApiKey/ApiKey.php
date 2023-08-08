<?php

namespace App\ApiKey;

use App\Models\ApiKey as ModelsApiKey;
use App\Router\Abort;

class ApiKey
{
    public static function shouldHaveValidKey(){
        if(isset($_SERVER['HTTP_APIKEY'])){
            $apiKey = ModelsApiKey::where('api_key', $_SERVER['HTTP_APIKEY'])->get();
            if(count($apiKey) > 0){
                return;
            }
        }
        Abort::badRequest('No valid key provided');
    }
}