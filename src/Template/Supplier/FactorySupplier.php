<?php
namespace AstroStudio\Core\Template\Supplier;

use AstroStudio\Core\Template\Factory\FactoryInterface;

/**
 * @template T
 * @implements SupplierInterface<T>
 */
class FactorySupplier implements SupplierInterface
{
    /**
     * @var FactoryInterface<T>
     */
    protected FactoryInterface $factory;

    /**
     * @param FactoryInterface<T> $factory
     */
    public function __construct(FactoryInterface $factory){
        $this->factory = $factory;
    }

    public function get(): mixed
    {
        return $this->factory->get();
    }
}