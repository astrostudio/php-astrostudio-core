<?php
namespace AstroStudio\Core\Template\Filter;

/**
 * @template T
 */
interface FilterInterface
{
    /**
     * @param T       $value
     * @param mixed[] $options
     *
     * @return bool
     */
    public function check(mixed $value, array $options = []): bool;
}
