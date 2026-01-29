<?php
namespace AstroStudio\Core\Template\Factory;

/**
 * @template T
 */
interface FactoryInterface
{
    /**
     * @return T
     */
    public function get(): mixed;
}