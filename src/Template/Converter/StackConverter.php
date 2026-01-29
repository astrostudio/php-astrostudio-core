<?php
namespace AstroStudio\Core\Template\Converter;

/**
 * @template S
 * @template T
 * @extends  AbstractConverter<S,T>
 */
class StackConverter extends AbstractConverter
{
    /**
     * @var ConverterInterface<S,T>[]
     */
    protected array $converters;

    /**
     * @param ConverterInterface<S,T>[] $converters
     */
    public function __construct(array $converters = [])
    {
        $this->converters = $converters;
    }

    public function convert($value, array $options = []): mixed
    {
        foreach($this->converters as $converter){
            if(!is_null($newValue = $converter->convert($value, $options))) {
                return $newValue;
            }
        }

        return null;
    }
}
