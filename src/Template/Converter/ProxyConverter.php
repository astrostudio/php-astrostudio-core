<?php
namespace AstroStudio\Core\Template\Converter;

/**
 * @template S
 * @template T
 * @extends  AbstractConverter<S,T>
 */
class ProxyConverter extends AbstractConverter
{
    /**
     * @var ConverterInterface <S,T>
     */
    protected ConverterInterface $converter;
    /**
     * @var mixed[]
     */
    protected array $options;

    /**
     * @param ConverterInterface<S,T> $converter
     * @param mixed[]                 $options
     */
    public function __construct(ConverterInterface $converter, array $options = [])
    {
        $this->converter = $converter;
        $this->options = $options;
    }

    public function convert($value, array $options = []): mixed
    {
        return $this->converter->convert($value, array_merge($this->options, $options));
    }

    public function convertMany(array $values = [], array $options = []): array
    {
        return $this->convertMany($values, array_merge($this->options, $options));
    }
}
