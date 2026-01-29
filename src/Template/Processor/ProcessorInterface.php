<?php
namespace AstroStudio\Core\Template\Processor;

/**
 * @template T
 */
interface ProcessorInterface
{
    /**
     * @param T       $value
     * @param mixed[] $options
     *
     * @return void
     */
    function process($value, array $options = []): void;

    /**
     * @param T[]     $values
     * @param mixed[] $options
     *
     * @return void
     */
    function processMany(array $values = [], array $options = []): void;
}
