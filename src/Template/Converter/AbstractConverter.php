<?php
namespace AstroStudio\Core\Template\Converter;

/**
 * @template   S
 * @template   T
 * @implements ConverterInterface<S,T>
 */
abstract class AbstractConverter implements ConverterInterface
{
    public function convertMany(array $values = [], array $options = []): array
    {
        $newValues = [];

        foreach($values as $key=>$value){
            $newValues[$key]=$this->convert($value, $options);
        }

        return $newValues;
    }
}
