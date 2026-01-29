<?php
namespace AstroStudio\Core\Template\Supplier;

/**
 * @template   T
 * @implements SupplierInterface<T>
 */
class ValueSupplier implements SupplierInterface
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
