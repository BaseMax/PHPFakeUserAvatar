<?php

namespace App\Validator;

use App\Router\Abort;

class UniqueValidator implements IsValidator
{
    public function validate($key, $data, $extera = null){
        $user = $extera::where($key, $data[$key])->count();
        if($user != 0){
            Abort::badRequest($key.' already exists on '.$extera);
        }
    }
}