<?php
namespace AstroStudio\Core\Template\Modifier;

/**
 * @template T
 */
interface ModifierInterface
{
    /**
     * @param T       $value
     * @param mixed[] $options
     *
     * @return T
     */
    function modify(mixed $value, array $options = []): mixed;

    /**
     * @param T[]     $values
     * @param mixed[] $options
     *
     * @return T[]
     */
    function modifyMany(array $values = [], array $options = []): array;
}
