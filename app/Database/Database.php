<?php

namespace App\Database;

use Illuminate\Database\Capsule\Manager as Capsule;

class Database
{
    public static function init(){
        $capsule = new Capsule;
        $capsule->addConnection([
            'driver'   => 'mysql',
            'host'     => '127.0.0.1',
            'database' => 'fakeuseravatar',
            'username' => 'root',
            'password' => '',
        ]);
        $capsule->setAsGlobal();
        $capsule->bootEloquent();
    }
}