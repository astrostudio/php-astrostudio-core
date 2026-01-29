<?php
namespace Base\Cache;

class ProxyCache extends BaseCache
{
    protected $_cache;

    public function __construct(CacheInterface $cache=null){
        $this->_cache=$cache;
    }

    public function has(string $key):bool
    {
        return($this->_cache?$this->_cache->has($key):false);
    }

    public function get(string $key){
        return($this->_cache?$this->_cache->get($key):null);
    }

    public function set(string $key,$value){
        if($this->_cache){
            $this->_cache->set($key,$value);
        }
    }

    public function remove(string $key){
        if($this->_cache){
            $this->_cache->remove($key);
        }
    }
}
