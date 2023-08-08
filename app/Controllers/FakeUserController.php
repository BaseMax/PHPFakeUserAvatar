<?php

namespace App\Controllers;

use App\ApiKey\ApiKey;
use App\Router\Response;
use App\Models\FakeUser;
use App\Router\Abort;
use OpenApi\Annotations as OA;

class FakeUserController
{
    function __construct()
    {
        ApiKey::shouldHaveValidKey();
    }

    /**
     * @OA\Get(
     *     path="/api/get-fake-users",
     *     summary="Get some fake user",
     *     description="Retrieve a list of 10-20 fake user information, including avatars if available",
     *     @OA\Parameter(
     *         name="APIKEY",
     *         in="header",
     *         description="Api Key",
     *         required=true,
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\Property(
     *             type="array",
     *             @OA\Items(
     *                 @OA\Property(
     *                     property="id",
     *                     type="integer",
     *                 ),
     *                 @OA\Property(
     *                     property="first_name",
     *                     type="string",
     *                 ),
     *                 @OA\Property(
     *                     property="last_name",
     *                     type="string",
     *                 ),
     *                 @OA\Property(
     *                     property="email",
     *                     type="string",
     *                 ),
     *                 @OA\Property(
     *                     property="avatar_url",
     *                     type="string",
     *                 ),
     *                 @OA\Property(
     *                     property="created_at",
     *                     type="string",
     *                 ),
     *                 @OA\Property(
     *                     property="updated_at",
     *                     type="string",
     *                 )
     *             ),
     *             example={{"id":61,"first_name":"Creola","last_name":"Rodriguez","email":"jakubowski.flo@yahoo.com","avatar_url":"https:\/\/via.placeholder.com\/360x360.png\/0055aa?text=person+ut","created_at":"2023-08-08T06:38:24.000000Z","updated_at":"2023-08-08T06:38:24.000000Z"}}
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="No valid key provided",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="message",
     *                 type="string"
     *             ),
     *             example={"message": "No valid key provided"}
     *         )
     *     )
     * )
     */
    public function getFakeUsers(){
        Response::json(FakeUser::limit(20)->get());
    }

    /**
     * @OA\Get(
     *     path="/api/get-random-fake-user",
     *     summary="Get a random fake user",
     *     description="Retrieve a random fake user's information, including the avatar if available",
     *     @OA\Parameter(
     *         name="APIKEY",
     *         in="header",
     *         description="Api Key",
     *         required=true,
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="id",
     *                 type="integer",
     *             ),
     *             @OA\Property(
     *                 property="first_name",
     *                 type="string",
     *             ),
     *             @OA\Property(
     *                 property="last_name",
     *                 type="string",
     *             ),
     *             @OA\Property(
     *                 property="email",
     *                 type="string",
     *             ),
     *             @OA\Property(
     *                 property="avatar_url",
     *                 type="string",
     *             ),
     *             @OA\Property(
     *                 property="created_at",
     *                 type="string",
     *             ),
     *             @OA\Property(
     *                 property="updated_at",
     *                 type="string",
     *             ),
     *             example={"id":61,"first_name":"Creola","last_name":"Rodriguez","email":"jakubowski.flo@yahoo.com","avatar_url":"https:\/\/via.placeholder.com\/360x360.png\/0055aa?text=person+ut","created_at":"2023-08-08T06:38:24.000000Z","updated_at":"2023-08-08T06:38:24.000000Z"}
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="No valid key provided",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="message",
     *                 type="string"
     *             ),
     *             example={"message": "No valid key provided"}
     *         )
     *     )
     * )
     */
    public function getRandomFakeUser(){
        $fakeUsers = FakeUser::limit(20)->get();
        if(count($fakeUsers) > 0){
            $randomKey = random_int(0, count($fakeUsers) - 1);
            Response::json($fakeUsers[$randomKey]);
        }
        Abort::serverError('No fake user available');
    }
}