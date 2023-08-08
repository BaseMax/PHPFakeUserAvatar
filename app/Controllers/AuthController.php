<?php

namespace App\Controllers;

use App\Router\Response;
use App\Models\User;
use App\Router\Abort;
use App\Auth\Auth;
use App\Validator\Validator;
use OpenApi\Annotations as OA;

/**
 * @OA\Info(title="PHP Fake User Avatar Api", version="1")
 */
class AuthController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/login",
     *     summary="Login",
     *     description="Login a user and generate JWT token",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="email",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="password",
     *                     type="string"
     *                 ),
     *                 example={"email": "mohammad@joubeh.com", "password": "123456"}
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="token",
     *                 type="string"
     *             ),
     *             example={"token": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6MTZ9.SLZRXQeFa64LGhAetQ-accbiNNa20bPaWoIbV9T0jx4"}
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid email or password",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="message",
     *                 type="string"
     *             ),
     *             example={"message": "email or password is not valid"}
     *         )
     *     )
     * )
     */
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

    /**
     * @OA\Post(
     *     path="/api/register",
     *     summary="Register",
     *     description="Register a user and generate JWT token",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="name",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="email",
     *                     type="string"
     *                 ),
     *                 @OA\Property(
     *                     property="password",
     *                     type="string"
     *                 ),
     *                 example={"name": "mohammad", "email": "mohammad@joubeh.com", "password": "123456"}
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="token",
     *                 type="string"
     *             ),
     *             example={"token": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6MTZ9.SLZRXQeFa64LGhAetQ-accbiNNa20bPaWoIbV9T0jx4"}
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Email already exists",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="message",
     *                 type="string"
     *             ),
     *             example={"message": "email already exists"}
     *         )
     *     )
     * )
     */
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