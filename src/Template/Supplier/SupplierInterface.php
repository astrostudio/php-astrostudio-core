<?php
namespace AstroStudio\Core\Template\Supplier;

/**
 * @template T
 */
interface SupplierInterface
{
    /**
     * @return T
     */
    public function get(): mixed;
}
