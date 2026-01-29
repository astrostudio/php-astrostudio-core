<?php
namespace Base\Cache;

class PrefixCache extends ProxyCache
{
    protected $_prefix;

    public function __construct(string $prefix,CacheInterface $cache=null){
        parent::__construct($cache);

        $this->_prefix=$prefix;
    }

    public function has(string $key):bool
    {
        return(parent::has($this->_prefix.$key));
    }

    public function get(string $key){
        return(parent::get($this->_prefix.$key));
    }

    public function set(string $key,$value){
        parent::set($this->_prefix.$key,$value);
    }

    public function remove(string $key){
        parent::remove($this->_prefix.$key);
    }
}
