<?php
namespace AstroStudio\Core\Cache;

use AstroStudio\Core\Hash;

class ProxyCache extends AbstractCache
{
    protected CacheInterface $cache;
    protected array $options;

    public function __construct(CacheInterface $cache, array $options = [])
    {
        $this->cache=$cache;
        $this->options = $options;
    }

    public function has(string $key, array $options = []):bool
    {
        return $this->cache->has($key, Hash::extend($this->options, $options));
    }

    public function get(string $key, array $options = []): mixed
    {
        return $this->cache->get($key, Hash::extend($this->options, $options));
    }

    public function set(string $key,mixed $value, array $options = []): void
    {
        $this->cache->set($key, $value, Hash::extend($this->options, $options));
    }

    public function remove(string $key, array $options = []): void
    {
        $this->cache->remove($key, Hash::extend($this->options, $options));
    }
}
