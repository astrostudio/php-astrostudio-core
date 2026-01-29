<?php
namespace AstroStudio\Core\Api;

use AstroStudio\Core\Cache\CacheInterface;

class CacheApi extends ProxyApi
{
    protected CacheInterface $cache;

    public function __construct(ApiInterface $api,CacheInterface $cache)
    {
        parent::__construct($api);

        $this->cache=$cache;
    }

    public function execute(string $name,ApiQueryInterface $query, array $options = []): mixed
    {
        $key=strval(crc32(json_encode([$name,$query,$options])));

        $result=$this->cache->get($key);

        if(!is_null($result)) {
            $result=parent::execute($name, $query, $options);

            $this->cache->set($key, $result);
        }

        return $result;
    }
}
