<?php

namespace App\Validator;

use App\Router\Abort;
use App\Router\Response;

class RequiredValidator implements IsValidator
{
    public function validate($key, $data, $extera = null){
        if($data && array_key_exists($key, $data)){
            return true;
        }
        Abort::badRequest($key.' is required');
    }
}