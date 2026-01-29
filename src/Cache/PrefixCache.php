<?php
namespace AstroStudio\Core\Cache;

class PrefixCache extends ProxyCache
{
    protected string $prefix;

    public function __construct(string $prefix,CacheInterface $cache, array $options = [])
    {
        parent::__construct($cache, $options);

        $this->prefix=$prefix;
    }

    public function has(string $key, array $options = []):bool
    {
        return parent::has($this->prefix.$key, $options);
    }

    public function get(string $key, array $options = []): mixed
    {
        return parent::get($this->prefix.$key, $options);
    }

    public function set(string $key,mixed $value, array $options = []): void
    {
        parent::set($this->prefix.$key, $value, $options);
    }

    public function remove(string $key, array $options = []): void
    {
        parent::remove($this->prefix.$key, $options);
    }
}
