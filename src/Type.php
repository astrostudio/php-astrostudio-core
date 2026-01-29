<?php
namespace AstroStudio\Core;

use InvalidArgumentException;

class Type
{
    const ANY = 'any';
    const NULL = 'null';
    const STRING = 'string';
    const INTEGER = 'integer';
    const BOOLEAN = 'boolean';
    const FLOAT = 'double';
    const OBJECT = 'object';
    const ARRAY = 'array';
    const CALLABLE = 'callable';
    const RESOURCE = 'resource';

    /**
     * @param string|string[] $type
     *
     * @return string[]
     */
    static public function list(string|array $type = self::ANY): array
    {
        if(is_string($type)) {
            $type = explode('|', $type);
        }

        return $type;
    }

    /**
     * @param mixed|null $value
     * @param bool       $asObject
     * @param bool       $asCallable
     *
     * @return string
     */
    static public function get(
        mixed $value = null,
        bool $asObject = false,
        bool $asCallable = false
    ): string {
        $type = strtolower(gettype($value));

        if($type === self::OBJECT) {
            if($asCallable) {
                if(is_callable($value)) {
                    return self::CALLABLE;
                }
            }

            if(!$asObject) {
                if(is_object($value)) {
                    return get_class($value);
                }

                return '';
            }

            return $type;
        }

        return $type;
    }

    /**
     * @param mixed|null      $value
     * @param string|string[] $type
     * @param bool            $asObject
     * @param bool            $asCallable
     *
     * @return bool
     */
    static public function is(
        mixed $value = null,
        string|array $type = self::ANY,
        bool $asObject = false,
        bool $asCallable = false
    ): bool {
        $types = self::list($type);

        foreach($types as $t){
            if($t == self::ANY) {
                return true;
            }

            if(self::get($value, $asObject, $asCallable) == $t) {
                return true;
            }

            if(!$asObject) {
                if(is_string($value) or is_object($value)) {
                    if (is_subclass_of($value, $t)) {
                        return true;
                    }
                }
            }
        }

        return false;
    }

    /**
     * @param mixed|null      $value
     * @param string|string[] $type
     * @param bool            $asObject
     * @param bool            $asCallable
     *
     * @return void
     */
    static public function assert(
        mixed $value = null,
        string|array $type = self::ANY,
        bool $asObject = false,
        bool $asCallable = false
    ): void {
        if(!self::is($value, $type, $asObject, $asCallable)) {
            throw new InvalidArgumentException();
        }
    }

    /**
     * @param mixed|null      $value
     * @param string|string[] $type
     * @param bool            $asObject
     * @param bool            $asCallable
     *
     * @return mixed
     */
    static public function pass(
        mixed $value = null,
        string|array $type = self::ANY,
        bool $asObject = false,
        bool $asCallable = false
    ) : mixed {
        self::assert($value, $type, $asObject, $asCallable);

        return $value;
    }

    /**
     * @param mixed|null $value
     *
     * @return bool
     */
    static public function isKey(mixed $value = null): bool
    {
        return self::is($value, [self::INTEGER,self::STRING,self::BOOLEAN]);
    }

    /**
     * @param mixed[] $array
     *
     * @return bool
     */
    static public function isSet(array $array = []):bool
    {
        foreach($array as $key=>$value){
            if(!is_int($key)) {
                return false;
            }
        }

        return true;
    }

    /**
     * @param mixed[] $array
     *
     * @return bool
     */
    static public function isMap(array $array = []):bool
    {
        foreach($array as $key=>$value){
            if(is_int($key)) {
                return false;
            }
        }

        return true;
    }
}
