<?php
namespace AstroStudio\Core\Cache;

interface CacheInterface
{
    function has(string $key, array $options = []): bool;
    function get(string $key, array $options = []): mixed;
    function set(string $key,mixed $value, array $options = []): void;
    function remove(string $key, array $options = []): void;
}
