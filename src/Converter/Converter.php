<?php
namespace AstroStudio\Core\Converter\Converter;

use AstroStudio\Core\Template\Converter\ConverterInterface;

class Converter
{
    /**
     * @param mixed[]                           $values
     * @param ConverterInterface<mixed,mixed>[] $converters
     *
     * @return mixed[]
     */
    static public function convertHash(array $values = [], array $converters = []): array
    {
        return $values;
    }
}
