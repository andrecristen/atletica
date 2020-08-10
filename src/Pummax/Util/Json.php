<?php


namespace Pummax\Util;


class Json
{

    public static function encode($value){
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }

    public static function decode($value){
        return json_decode($value, true);
    }

}