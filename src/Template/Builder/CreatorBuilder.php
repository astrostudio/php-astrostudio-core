<?php
namespace AstroStudio\Core\Template\Builder;

use AstroStudio\Core\Template\Creator\CreatorInterface;

/**
 * @template T
 * @implements BuilderInterface<T>
 */
class CreatorBuilder implements BuilderInterface
{
    /**
     * @var array<string,CreatorInterface<T>>
     */
    protected array $creators;

    /**
     * @param array<string,CreatorInterface<T>> $creators
     */
    public function __construct(array $creators = []){
        $this->creators = $creators;
    }

    public function get(string $name, array $data = []): mixed
    {
        if(!array_key_exists($name, $this->creators)){
            return null;
        }

        return $this->creators[$name]->get($data);
    }
}