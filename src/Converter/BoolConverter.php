<?php
namespace AstroStudio\Core\Converter;

use AstroStudio\Core\Template\Converter\AbstractConverter;

/**
 * @extends AbstractConverter<mixed,mixed>
 */
class BoolConverter extends AbstractConverter
{
    public function convert($value, array $options = []): mixed
    {
        if(is_null($value)) {
            return null;
        }

        return boolval($value);
    }
}
