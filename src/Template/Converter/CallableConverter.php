<?php
namespace AstroStudio\Core\Template\Converter;

/**
 * @template S
 * @template T
 * @extends  AbstractConverter<S,T>
 */
class CallableConverter extends AbstractConverter
{
    /**
     * @var callable(S,mixed[]): (T|null)
     */
    protected $callable;

    /**
     * @param callable(S,mixed[]): (T|null) $callable
     */
    public function __construct(callable $callable)
    {
        $this->callable = $callable;
    }

    public function convert($value, array $options = []): mixed
    {
        return call_user_func($this->callable, $value, $options);
    }
}
