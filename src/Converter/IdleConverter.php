<?php
namespace AstroStudio\Core\Converter;

use AstroStudio\Core\Template\Converter\AbstractConverter;

/**
 * @extends AbstractConverter<mixed,mixed>
 */
class IdleConverter extends AbstractConverter
{
    public function convert($value, array $options = []): mixed
    {
        return $value;
    }
}
