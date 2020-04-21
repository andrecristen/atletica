<?php

namespace Pummax\Configuration;

class DataBase
{
    const URL_SITE = "https://atletica-ceavi.herokuapp.com/";

    public static function getConnectionConfiguration(){
        //Postgresql
        $conn = array(
            'dbname' => 'da24cdp7e3jitc',
            'user' => 'kjjrxucfxxaxjo',
            'port' => '5432',
            'password' => '971058513fff46baded61d894e563fc2a68a759770dc7951d1536e8fe4473a08',
            'host' => 'ec2-52-73-247-67.compute-1.amazonaws.com',
            'driver' => 'pdo_pgsql',
        );
        /*
        //MySql - Exemplo
        $conn = array(
            'dbname' => 'atletica',
            'user' => 'root',
            'host' => 'localhost',
            'driver' => 'pdo_mysql',
        );
        */
        return $conn;
    }

    public static function isDevMode(){
        return true;
    }

}