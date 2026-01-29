<?php
namespace AstroStudio\Core\Converter;

use AstroStudio\Core\Template\Converter\ConverterInterface;
use AstroStudio\Core\Template\Converter\ProxyConverter;
use AstroStudio\Core\Type;

/**
 * @extends ProxyConverter<mixed, mixed>
 */
class TypeConverter extends ProxyConverter
{
    /**
     * @var string[]
     */
    protected array $type;

    /**
     * @param ConverterInterface<mixed, mixed> $converter
     * @param string|string[]                  $type
     * @param mixed[]                          $options
     */
    public function __construct(ConverterInterface $converter, string|array $type = Type::ANY, array $options = [])
    {
        parent::__construct($converter, $options);

        $this->type = Type::list($type);
    }

    public function convert($value, array $options = []): mixed
    {
        if(is_null($newValue = parent::convert($value, $options))) {
            return null;
        }

        if(!Type::is($newValue, $this->type)) {
            return null;
        }

        return $newValue;
    }
}
