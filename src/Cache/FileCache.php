<?php
namespace AstroStudio\Core\Cache;

class FileCache extends AbstractCache
{
    protected string $directory;

    public function __construct(string $directory='')
    {
        $this->directory=$directory;
    }

    public function path(string $key, array $options = []):string
    {
        return $this->directory.DIRECTORY_SEPARATOR.$key;
    }

    public function has(string $key, array $options = []): bool
    {
        return file_exists($this->path($key));
    }

    public function get(string $key, array $options = []): mixed
    {
        $s=file_get_contents($this->path($key));

        return unserialize($s);
    }

    public function set(string $key, mixed $value, array $options = []): void
    {
        $s=serialize($value);

        file_put_contents($this->path($key), $s);
    }

    public function remove(string $key, array $options = []): void
    {
        unlink($this->path($key));
    }
}
