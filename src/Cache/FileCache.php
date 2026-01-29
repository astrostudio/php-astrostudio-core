<?php
namespace Base\Cache;

class FileCache extends BaseCache
{
    protected $_directory;

    public function __construct(string $directory=''){
        $this->_directory=$directory;
    }

    public function path(string $key):string
    {
        return($this->_directory.DIRECTORY_SEPARATOR.$key);
    }

    public function has(string $key): bool
    {
        return(file_exists($this->path($key)));
    }

    public function get(string $key)
    {
        $s=file_get_contents($this->path($key));

        return(unserialize($s));
    }

    public function set(string $key, $value)
    {
        $s=serialize($value);

        file_put_contents($this->path($key),$s);
    }

    public function remove(string $key)
    {
        unlink($this->path($key));
    }
}