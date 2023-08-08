<?php

namespace App\Auth;

use App\Models\User;
use App\Router\Abort;
use MiladRahimi\Jwt\Generator;
use MiladRahimi\Jwt\Parser;
use MiladRahimi\Jwt\Cryptography\Algorithms\Hmac\HS256;

class Auth
{
    public static $user = null;

    public static function issueToken($userId){
        $signer = new HS256($_ENV['JWT_SECRET']);
        $generator = new Generator($signer);
        $jwt = $generator->generate(['id' => $userId]);
        return $jwt;
    }

    public static function check($jwt){
        $signer = new HS256($_ENV['JWT_SECRET']);
        $parser = new Parser($signer);
        try{
            $claims = $parser->parse($jwt);
            return [true, $claims['id']];
        } catch (\Exception $e) {
            return [false, null];
        }
    }

    public static function shouldBeAuthorized(){
        if (isset($_SERVER['HTTP_AUTHORIZATION']) && preg_match('/Bearer\s(\S+)/', $_SERVER['HTTP_AUTHORIZATION'], $matches)) {
            $jwt = $matches[1];
            if($jwt) {
                $res = self::check($jwt);
                if($res[0]){
                    $user = User::where('id', $res[1])->get();
                    if(count($user) > 0){
                        self::$user = $user[0];
                        return;
                    }
                }
            }
        }
        Abort::badRequest('Not authorized');
    }
}