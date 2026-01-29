<?php
namespace AstroStudio\Core;

class Value
{
    static public function get(mixed $value, ...$args): mixed
    {
        if(is_callable($value)) {
            return self::get(call_user_func($value, $args));
        }

        return $value;
    }

    static public function def(mixed $value, ...$args): mixed
    {
        $value = self::get($value);

        if(!is_null($value)) {
            return $value;
        }

        foreach($args as $arg){
            if(!is_null($arg)) {
                return $arg;
            }
        }

        return null;
    }
}
