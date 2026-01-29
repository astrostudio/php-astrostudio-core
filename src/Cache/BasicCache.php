<?php
namespace Base\Cache;

class BasicCache extends BaseCache
{
    protected $_values=[];

    public function has(string $key):bool
    {
        return(isset($this->_values[$key]));
    }

    public function get(string $key){
        return($this->_values[$key]??null);
    }

    public function set(string $key,$value){
        $this->_values[$key]=$value;
    }

    public function remove(string $key){
        unset($this->_values[$key]);
    }
}
