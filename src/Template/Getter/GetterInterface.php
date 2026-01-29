<?php
namespace AstroStudio\Core\Template\Getter;

/**
 * @template T
 */
interface GetterInterface
{
    /**
     * @param T      $value
     * @param string|int $key
     *
     * @return bool
     */
    public function has(mixed $value, string|int $key): bool;

    /**
     * @param T     $value
     * @param string|int $key
     *
     * @return mixed
     */
    public function get(mixed $value, string|int $key): mixed;
}