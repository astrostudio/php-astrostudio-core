<?php
namespace AstroStudio\Core\Template\Provider;

use AstroStudio\Core\Template\Factory\FactoryInterface;

/**
 * @template T
 * @implements ProviderInterface<T>
 */
class FactoryProvider implements ProviderInterface
{
    /**
     * @var array<string, FactoryInterface<T>>
     */
    protected array $factories;

    /**
     * @param array<string, FactoryInterface<T>> $factories
     */
    public function __construct(array $factories = []){
        $this->factories = $factories;
    }

    public function get(string $name): mixed
    {
        if(!array_key_exists($name, $this->factories)){
            return null;
        }

        return $this->factories[$name]->get();
    }
}