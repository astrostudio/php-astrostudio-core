<?php
namespace AstroStudio\Core\Cache;

interface CacheInterface
{
    function has(string $key): bool;
    function get(string $key): mixed;
    function set(string $key,$value): void;
    function remove(string $key): void;
}
