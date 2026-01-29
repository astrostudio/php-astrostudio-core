<?php
namespace AstroStudio\Core\Template\Setter;

/**
 * @template T
 */
interface SetterInterface
{
    /**
     * @param T          $value
     * @param string|int $key
     * @param mixed      $subValue
     *
     * @return void
     */
    public function set(mixed $value, string|int $key, mixed $subValue): void;

    /**
     * @param T          $value
     * @param string|int $key
     *
     * @return void
     */
    public function remove(mixed $value, string|int $key): void;
}
