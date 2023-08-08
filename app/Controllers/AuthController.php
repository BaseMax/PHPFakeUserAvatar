<?php

namespace App\Controllers;

use App\Router\Response;
use App\Models\User;
use App\Router\Abort;
use App\Auth\Auth;
use App\Validator\Validator;

class AuthController extends Controller
{
    public function login(){
        $data = $this->getJsonBody();
        Validator::validate($data, [
            'email' => ['required'],
            'password' => ['required']
        ]);
        $user = User::where('email', $data['email'])->get();
        if(count($user) == 0 || !password_verify($data['password'], $user[0]->password)){
            Abort::badRequest('email or password is not valid');
        }
        $token = Auth::issueToken($user[0]->id);
        Response::json(['token' => $token]);
    }

    public function register(){
        $data = $this->getJsonBody();
        Validator::validate($data, [
            'name' => ['required'],
            'email' => ['required', 'unique:App\Models\User'],
            'password' => ['required']
        ]);
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => password_hash($data['password'], PASSWORD_DEFAULT),
        ]);
        $token = Auth::issueToken($user->id);
        Response::json(['token' => $token]);
    }
}