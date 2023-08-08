<?php

namespace App\Controllers;

use App\Auth\Auth;
use App\Models\ApiKey;
use App\Router\Abort;
use App\Router\Response;
use OpenApi\Annotations as OA;

class KeyController
{
    function __construct()
    {
        Auth::shouldBeAuthorized();
    }

    /**
     * @OA\Get(
     *     path="/api/get-keys",
     *     summary="Get api keys",
     *     description="Retrieve a list of API keys associated with the authenticated user",
     *     @OA\Parameter(
     *         name="Authorization",
     *         in="header",
     *         description="Auth token",
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
     *                     property="user_id",
     *                     type="integer",
     *                 ),
     *                 @OA\Property(
     *                     property="api_key",
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
     *             example={{"id":21,"user_id":16,"api_key":"16_64d1edaef3396","created_at":"2023-08-08T07:24:31.000000Z","updated_at":"2023-08-08T07:24:31.000000Z"}}
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Not authorized",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="message",
     *                 type="string"
     *             ),
     *             example={"message": "Not authorized"}
     *         )
     *     )
     * )
     */
    public function getKeys(){
        $apiKeys = Auth::$user->apiKeys;
        Response::json($apiKeys);
    }

    /**
     * @OA\Post(
     *     path="/api/create-key",
     *     summary="Create Api Key",
     *     description="Create a new API key for the authenticated user",
     *     @OA\Parameter(
     *         name="Authorization",
     *         in="header",
     *         description="Auth token",
     *         required=true,
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="id",
     *                 type="integer"
     *             ),
     *             @OA\Property(
     *                 property="user_id",
     *                 type="integer"
     *             ),
     *             @OA\Property(
     *                 property="api_key",
     *                 type="string"
     *             ),
     *             @OA\Property(
     *                 property="updated_at",
     *                 type="string"
     *             ),
     *             @OA\Property(
     *                 property="created_at",
     *                 type="string"
     *             ),
     *             example={"user_id":16,"api_key":"16_64d20e314b5cd","updated_at":"2023-08-08T09:43:13.000000Z","created_at":"2023-08-08T09:43:13.000000Z","id":27}
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Not authorized",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="message",
     *                 type="string"
     *             ),
     *             example={"message": "Not authorized"}
     *         )
     *     )
     * )
     */
    public function createKey(){
        $apiKey = ApiKey::create([
            'user_id' => Auth::$user->id,
            'api_key' => uniqid(Auth::$user->id.'_')
        ]);
        Response::json($apiKey);
    }

    /**
     * @OA\Delete(
     *     path="/api/delete-key/{key}",
     *     summary="Delete Api Key",
     *     description="Delete the specified API key belonging to the authenticated user",
     *     @OA\Parameter(
     *         name="key",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="Authorization",
     *         in="header",
     *         description="Auth token",
     *         required=true,
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="message",
     *                 type="string"
     *             ),
     *             example={"message": "Key deleted"}
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Not authorized",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="message",
     *                 type="string"
     *             ),
     *             example={"message": "Not authorized"}
     *         )
     *     )
     * )
     */
    public function deleteKey($keyId){
        $apiKey = ApiKey::where('api_key', $keyId)->where('user_id', Auth::$user->id)->get();
        if(count($apiKey) > 0){
            $apiKey[0]->delete();
            Response::json(['message' => 'Key deleted']);
        } else {
            Abort::badRequest('Key not found');
        }
    }
}