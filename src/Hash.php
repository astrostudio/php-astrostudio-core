<?php
namespace AstroStudio\Core;

use Exception;

class Hash
{
    const SEPARATOR='.';

    /**
     * @param (string|int)[]|string|int $path
     * @param string                    $separator
     *
     * @return (string|int)[]
     */
    static public function path(array|string|int $path,string $separator=self::SEPARATOR):array
    {
        if(is_array($path)) {
            return $path;
        }

        if(is_int($path)) {
            return [$path];
        }

        if(mb_strlen($separator) == 0) {
            return [$path];
        }

        return explode($separator, $path);
    }

    /**
     * @param mixed[] $data
     *
     * @return mixed[]
     */
    static public function extend(array $data): array
    {
        $args=func_get_args();
        $return=current($args);

        foreach($args as $arg){
            foreach ((array)$arg as $key => $val) {
                if(is_int($key)) {
                    $return[]=$val;
                } else if(!empty($return[$key]) && is_array($return[$key]) && is_array($val)) {
                    $return[$key]=self::extend($return[$key], $val);
                } else {
                    $return[$key]=$val;
                }
            }
        }

        return($return);
    }

    /**
     * @param mixed[]                   $hash
     * @param (string|int)[]|string|int $path
     * @param string                    $separator
     *
     * @return bool
     */
    static public function has(array $hash,array|string|int $path,string $separator=self::SEPARATOR):bool
    {
        $path=self::path($path, $separator);
        $data=&$hash;

        while(!empty($path)){
            $item=array_shift($path);

            if(!is_array($data)) {
                return false;
            }

            if(!array_key_exists($item, $data)) {
                return false;
            }

            $data=&$data[$item];
        }

        return true;
    }

    /**
     * @param mixed[]                   $hash
     * @param (string|int)[]|string|int $path
     * @param mixed                     $value
     * @param string                    $separator
     *
     * @return mixed
     */
    static public function get(array $hash,array|string|int $path,mixed $value=null,string $separator=self::SEPARATOR):mixed
    {
        $path=self::path($path, $separator);
        $data=&$hash;

        while(!empty($path)){
            $item=array_shift($path);

            if(!is_array($data)) {
                return $value;
            }

            if(!array_key_exists($item, $data)) {
                return $value;
            }

            $data=&$data[$item];
        }

        return $data;
    }

    /**
     * @param mixed[]                   $hash
     * @param (string|int)[]|string|int $path
     * @param mixed                     $value
     * @param string                    $separator
     *
     * @return void
     */
    static public function set(array &$hash,array|string|int $path,mixed $value=null,string $separator=self::SEPARATOR):void
    {
        $path=self::path($path, $separator);
        $data=&$hash;

        while(!empty($path)){
            $item=array_shift($path);

            if(!is_array($data)) {
                $data=[];
            }

            if(!array_key_exists($item, $data)) {
                $data[$item]=[];
            }

            $data=&$data[$item];
        }

        $data=$value;
    }

    /**
     * @param mixed[]                   $hash
     * @param (string|int)[]|string|int $path
     * @param mixed                     $value
     * @param string                    $separator
     *
     * @return void
     */
    static public function add(array &$hash,array|string|int $path,mixed $value=null,string $separator=self::SEPARATOR):void
    {
        $path=self::path($path, $separator);
        $data=&$hash;

        while(!empty($path)){
            $item=array_shift($path);

            if(!is_array($data)) {
                $data=[];
            }

            if(!array_key_exists($item, $data)) {
                $data[$item]=[];
            }

            $data=&$data[$item];
        }

        if(!is_array($data)) {
            $data=[];
        }

        $data[]=$value;
    }

    /**
     * @param mixed[]                 $hash
     * @param (string|int)|string|int $path
     * @param string                  $separator
     *
     * @return void
     */
    static public function remove(array &$hash,array|string|int $path,string $separator=self::SEPARATOR):void
    {
        $path=self::path($path, $separator);
        $data=&$hash;

        while(!empty($path)){
            $item=array_shift($path);

            if(!is_array($data)) {
                $data=[];
            }

            if(!array_key_exists($item, $data)) {
                $data[$item]=[];
            }

            $data=&$data[$item];
        }

        unset($data);
    }

    static public function leave(array $hash=[],array $paths=[], string $separator = self::SEPARATOR)
    {
        $newHash=[];

        foreach($paths as $path){
            if(self::has($hash, $path, $separator)) {
                $newHash[$path]=self::get($hash, $path, null, $separator);
            }
        }

        return $newHash;
    }


    /**
     * @param mixed[] $hash
     * @param string  $separator
     *
     * @return mixed[]
     */
    static public function flatten(array $hash,string $separator=self::SEPARATOR):array
    {
        $newHash=[];

        foreach($hash as $key=>$value){
            if(!is_array($value)) {
                $newHash[$key]=$value;

                continue;
            }

            $subHash=self::flatten($hash, $separator);

            foreach($subHash as $subKey=>$subValue){
                $newHash[$key.$separator.$subKey]=$subValue;
            }
        }

        return $newHash;
    }

    /**
     * @param mixed[]    $hash
     * @param string|int $name
     * @param mixed      $item
     * @param int|null   $offset
     *
     * @return mixed[]
     */
    static public function insert(array $hash,string|int $name,mixed $item,?int $offset=null):array
    {
        $count=count($hash);
        $offset=$offset??$count;

        return(array_slice($hash, 0, $offset, true)+[$name=>$item]+array_slice($hash, $offset, $count, true));
    }

    /**
     * @param mixed[]                 $hash
     * @param (string|int)|string|int $path
     * @param mixed|null              $value
     * @param bool                    $notEmpty
     * @param string                  $separator
     *
     * @return void
     */
    static public function attach(array &$hash,array|string|int $path,mixed $value=null,bool $notEmpty=false, string $separator=self::SEPARATOR):void
    {
        if($notEmpty) {
            if(empty($value)) {
                return;
            }
        }

        if(is_null($value)) {
            return;
        }

        self::set($hash, $path, $value, $separator);
    }

    /**
     * @param mixed[]    $hash
     * @param string|int $key
     *
     * @return void
     */
    public static function init(array &$hash, int|string $key, mixed $value):void
    {
        if(!array_key_exists($key, $hash)) {
            $hash[$key]=$value;
        }
    }

    /**
     * @param mixed[] $array
     * @param mixed[] $values
     *
     * @return void
     */
    public static function initMany(array &$array, array $values=[]): void
    {
        foreach($values as $key=>$value) {
            if(!array_key_exists($key, $array)) {
                $array[$key]=$value;
            }

            $array=&$array[$key];
        }
    }

    public static function render(array $array = [], array $values = []): array
    {
        $result = [];

        foreach ($array as $key => $value) {
            if (! is_int($key)) {
                $key = Text::render($key, $values);
            }

            if (is_array($value)) {
                $value = self::render($value, $values);
            } else {
                $value = Text::render($value, $values);
            }

            $result[$key] = $value;
        }

        return $result;
    }

    public static function renderSet(array $input=[], array $valueSet=[]): array
    {
        $output=[];

        foreach($valueSet as $values) {
            $output[]=self::render($input, $values);
        }

        return($output);
    }

    public static function copy($value = '', array $maps = []): array
    {
        $result = [];

        foreach ($maps as $key => $map) {
            if (is_string($value)) {
                $result[$key] = Text::render($value, $map);
            } elseif (is_array($value)) {
                $result[$key] = self::render($value, $map);
            } else {
                $result[$key] = $value;
            }
        }

        return $result;
    }

    public static function compare(array $one = [], array $two = []): bool
    {
        foreach ($one as $key => $value) {
            if (! isset($two[$key])) {
                return false;
            }

            if (is_array($value)) {
                if (! is_array($two[$key])) {
                    return false;
                }

                if (! self::compare($one[$key], $two[$key])) {
                    return false;
                }
            }

            if ($one[$key] !== $two[$key]) {
                return false;
            }

            unset($two[$key]);
        }

        return empty($two);
    }

    public static function disambiguate(array $array = [], ?string $suffix = null): array
    {
        $suffix ??= uniqid();
        $result = [];

        foreach ($array as $key => $value) {
            if (is_string($key)) {
                $key = Text::disabiguate($key, $suffix);
            }

            if (is_string($value)) {
                $value = Text::disabiguate($value, $suffix);
            }

            if (is_array($value)) {
                $value = self::disambiguate($value, $suffix);
            }

            $result[$key] = $value;
        }

        return $result;
    }

    static protected function _keys(array $hash=[]):array
    {
        $newHash=[];

        foreach($hash as $key=>$value){
            if(is_int($key)) {
                $newHash[$value]=true;

                continue;
            }

            if(is_array($value)) {
                $newHash[$key]=self::_keys($value);

                continue;
            }

            $newHash[$key]=$value;
        }

        return $newHash;
    }

    static protected function _convertValue(mixed $value,mixed $converter):mixed
    {
        if(is_null($converter)) {
            return $value;
        }

        if(is_callable($converter)) {
            return call_user_func($converter, $value);
        }

        return $value;
    }

    static protected function _convert(array $hash=[],array $keys=[],bool $only=false,?string $all=null):array
    {
        $newHash=[];

        if(is_null($all) and Type::isSet($hash)) {
            foreach($hash as $key=>$value){
                if(!is_array($value)) {
                    if($only) {
                        continue;
                    }

                    $newHash[$key]=$value;

                    continue;
                }

                $newHash[$key]=self::_convert($value, $keys, $only);
            }

            return $newHash;
        }

        if(!is_null($all)) {
            if(array_key_exists($all, $keys)) {
                foreach($hash as $key=>$value){
                    if(is_array($keys[$all])) {
                        if(is_array($value)) {
                            $newHash[$key]=self::_convert($value, $keys[$all], $only, $all);

                            continue;
                        }

                        if($only) {
                            continue;
                        }

                        $newHash[$key]=$value;

                        continue;
                    }

                    $newHash[$key]=self::_convertValue($value, $keys[$key]);
                }

                return $newHash;
            }
        }


        foreach($hash as $key=>$value){
            if(!array_key_exists($key, $keys)) {
                if($only) {
                    continue;
                }

                $newHash[$key]=$value;

                continue;
            }

            if(is_callable($keys[$key])) {
                $newHash[$key]=call_user_func($keys[$key], $value);

                continue;
            }

            if(is_array($keys[$key])) {
                if(is_array($value)) {
                    $newHash[$key]=self::_convert($value, $keys[$key], $only);

                    continue;
                }
            }

            $newHash[$key]=$value;
        }

        return $newHash;
    }

    static public function convert(array $hash=[],array $keys=[],bool $only=false,?string $all=null):array
    {
        $keys=self::_keys($keys);

        return self::_convert($hash, $keys, $only, $all);
    }

    static public function convertMany(array $valueSet=[],array $keys=[],bool $only=false,?string $all=null):array
    {
        $newValueSet=[];

        foreach($valueSet as $key=>$values){
            if(!is_array($values)) {
                $newValueSet[$key]=$values;

                continue;
            }

            $newValueSet[$key]=self::convert($values, $keys, $only, $all);
        }

        return $newValueSet;
    }

}
