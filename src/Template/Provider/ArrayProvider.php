<?php
namespace AstroStudio\Core\Template\Provider;

/**
 * @template T
 * @implements ProviderInterface<T>
 */
class ArrayProvider implements ProviderInterface
{
    /**
     * @var array<string,T>
     */
    protected array $values;

    /**
     * @param array<string,T> $values
     */
    public function __construct(array $values = []){
        $this->values = $values;
    }

    public function get(string $name): mixed
    {
        return $this->values[$name]??null;
    }
}