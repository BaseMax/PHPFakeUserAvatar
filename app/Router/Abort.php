<?php

namespace App\Router;

class Abort
{
    public static function notFound(){
        Response::json(['message' => 'Not found'], 404);
    }

    public static function badRequest($message){
        Response::json(['message' => $message], 400);
    }

    public static function serverError($message){
        Response::json(['message' => $message], 500);
    }
}