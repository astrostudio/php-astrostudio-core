<?php
namespace AstroStudio\Core\Template\Converter;

/**
 * @template S
 * @template T
 */
interface ConverterInterface
{
    /**
     * @param S       $value
     * @param mixed[] $options
     *
     * @return T|null
     */
    function convert($value, array $options = []): mixed;

    /**
     * @param S[]     $values
     * @param mixed[] $options
     *
     * @return (T|null)[]
     */
    function convertMany(array $values = [], array $options = []): array;
}
