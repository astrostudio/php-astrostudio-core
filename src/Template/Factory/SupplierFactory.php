<?php
namespace AstroStudio\Core\Template\Factory;

use AstroStudio\Core\Template\Supplier\SupplierInterface;

/**
 * @template   T
 * @implements FactoryInterface<T>
 */
class SupplierFactory implements FactoryInterface
{
    /**
     * @var SupplierInterface<T>
     */
    protected SupplierInterface $supplier;

    /**
     * @param SupplierInterface<T> $supplier
     */
    public function __construct(SupplierInterface $supplier)
    {
        $this->supplier = $supplier;
    }

    public function get(): mixed
    {
        return $this->supplier->get();
    }
}
