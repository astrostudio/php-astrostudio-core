<?php
namespace AstroStudio\Core\Template\Factory;

/**
 * @template   T
 * @implements FactoryInterface<T>
 */
class ValueFactory implements FactoryInterface
{
    /**
     * @var T
     */
    protected mixed $value;

    /**
     * @param T $value
     */
    public function __construct(mixed $value)
    {
        $this->value = $value;
    }

    public function get(): mixed
    {
        return $this->value;
    }
}
