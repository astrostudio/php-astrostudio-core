<?php
namespace AstroStudio\Core\Template\Set;

use AstroStudio\Core\Template\Mapper\MapperInterface;
use AstroStudio\Core\Template\Processor\ProcessorInterface;

/**
 * @template T
 */
interface SetInterface
{
    /**
     * @param ProcessorInterface<T> $processor
     * @param mixed[]               $options
     *
     * @return void
     */
    function each(ProcessorInterface $processor, array $options = []): void;

    /**
     * @param mixed[] $options
     *
     * @return int
     */
    function count(array $options = []): int;

    /**
     * @param MapperInterface<T> $mapper
     * @param mixed[]           $options
     *
     * @return mixed[]
     */
    function map(MapperInterface $mapper, array $options = []): array;
}
