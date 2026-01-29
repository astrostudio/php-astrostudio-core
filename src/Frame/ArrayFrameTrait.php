<?php
namespace AstroStudio\Core\Frame;

use AstroStudio\Core\Hash;

trait ArrayFrameTrait
{
    protected array $values = [];

    public function has(string $key): bool
    {
        return array_key_exists($key, $this->values);
    }

    public function get(array|string|null $key=null, mixed $value = null): mixed
    {
        if(is_null($key)) {
            return $this->values;
        }

        if(is_array($key)) {
            $values = [];

            foreach($key as $k=>$v){
                if(is_int($k)) {
                    if(!array_key_exists($v, $this->values)) {
                        continue;
                    }

                    $values[$v] = $this->values[$v];

                    continue;
                }

                if(!array_key_exists($k, $this->values)) {
                    $values[$k]=$v;

                    continue;
                }

                $values[$k] = $this->values[$k];
            }

            return $values;
        }

        return array_key_exists($key, $this->values)?$this->values[$key]:$value;
    }

    public function set(array|string $key = null, mixed $value = null): void
    {
        if(is_array($key)) {
            foreach($key as $k=>$v){
                $this->values[$k] = $v;
            }

            return;
        }

        $this->values[$key] = $value;
    }

    public function remove(array|string|null $key = null): void
    {
        if(is_null($key)) {
            $this->values = [];

            return;
        }

        if(is_array($key)) {
            foreach($key as $k){
                unset($this->values[$k]);
            }

            return;
        }

        unset($this->values[$key]);
    }
}
