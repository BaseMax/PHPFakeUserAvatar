<?php

namespace App\Validator;

use App\Router\Abort;

class UniqueValidator implements IsValidator
{
    public function validate($key, $data, $extera = null){
        $user = $extera::where('email', $data['email'])->get();
        if(count($user) != 0){
            Abort::badRequest($key.' already exists on '.$extera);
        }
    }
}