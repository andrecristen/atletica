<?php


namespace Pummax\Controller;


class PummaxReflection
{

    public static function callMethod($object, $methodName, Array $args = null)
    {
        if (is_null($args)) {
            return call_user_func(Array($object, $methodName));
        } else {
            return call_user_func_array(Array($object, $methodName), $args);
        }
    }

    public static function callProperty($object, $name, $type, $args = Array())
    {
        $match = null;
        if (preg_match('/(\w*)\/(.*)/', $name, $match)) {
            $objectNew = self::callProperty($object, $match[1], 'get');
            if ($objectNew !== null) {
                return self::callProperty($objectNew, $match[2], $type, $args);
            }
            return null;
        }
        return self::callMethod($object, $type . ucfirst($name), $args);
    }

    public static function callGetter($object, $name, Array $args = Array())
    {
        return self::callProperty($object, $name, 'get', $args);
    }

    public static function callSetter($object, $name, Array $args = Array())
    {
        return self::callProperty($object, $name, 'set', $args);
    }

}