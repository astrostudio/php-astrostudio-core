<?php
namespace AstroStudio\Core\Converter;

use AstroStudio\Core\Template\Converter\AbstractConverter;
use AstroStudio\Core\Type;

/**
 * @extends AbstractConverter<mixed, mixed>
 */
class MapConverter extends AbstractConverter
{
    /**
     * @var mixed[]
     */
    protected array $map;

    /**
     * @param mixed[] $map
     */
    public function __construct(array $map = [])
    {
        $this->map = $map;
    }

    public function convert($value, array $options = []): mixed
    {
        if(!Type::isKey($value)) {
            return null;
        }

        return $this->map[$value]??null;
    }
}
