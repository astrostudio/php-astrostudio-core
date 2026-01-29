<?php
namespace AstroStudio\Core\Converter;

use AstroStudio\Core\Template\Converter\AbstractConverter;

/**
 * @extends AbstractConverter<mixed, mixed>
 */
class ValueConverter extends AbstractConverter
{
    protected mixed $value;

    public function __construct(mixed $value = null)
    {
        $this->value = $value;
    }

    public function convert($value, array $options = []): mixed
    {
        return $this->value;
    }
}
