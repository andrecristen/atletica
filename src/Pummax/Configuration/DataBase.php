<?php

namespace Pummax\Configuration;

class DataBase
{
    const URL_SITE = "http://atleticaceavi.com.br/";

    public static function getConnectionConfiguration(){
        //Postgresql
        $conn = array(
            'dbname' => 'atletica',
            'user' => 'postgres',
            'port' => '5432',
            'password' => '123456',
            'host' => 'localhost',
            'driver' => 'pdo_pgsql',
        );
        //MySql
        $conn = array(
            'dbname' => 'atletica',
            'user' => 'root',
            'host' => 'localhost',
            'driver' => 'pdo_mysql',
        );
        return $conn;
    }

    public static function isDevMode(){
        return true;
    }

}