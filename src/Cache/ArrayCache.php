<?php
namespace AstroStudio\Core\Cache;

class ArrayCache extends AbstractCache
{
    protected array $values=[];

    public function has(string $key, array $options = []):bool
    {
        return array_key_exists($key, $this->values);
    }

    public function get(string $key, array $options = []): mixed
    {
        return $this->values[$key]??null;
    }

    public function set(string $key,mixed $value, array $options = []): void
    {
        $this->values[$key]=$value;
    }

    public function remove(string $key, array $options = []): void
    {
        unset($this->values[$key]);
    }
}
