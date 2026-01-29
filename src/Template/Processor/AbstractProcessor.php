<?php
namespace AstroStudio\Core\Template\Processor;

/**
 * @template   T
 * @implements ProcessorInterface<T>
 */
abstract class AbstractProcessor implements ProcessorInterface
{
    public function processMany(array $values = [], array $options = []): void
    {
        foreach($values as $value){
            $this->process($value, $options);
        }
    }
}
