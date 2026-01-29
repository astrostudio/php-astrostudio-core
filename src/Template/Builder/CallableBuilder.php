<?php
namespace AstroStudio\Core\Template\Builder;

/**
 * @template T
 * @implements BuilderInterface<T>
 */
class CallableBuilder implements BuilderInterface
{
    /**
     * @var callable(string,array):T|null
     */
    protected $callable;

    /**
     * @param callable(string, array): T $callable
     */
    public function __construct(callable $callable){
        $this->callable = $callable;
    }

    public function get(string $name, array $data = []): mixed
    {
        return call_user_func($this->callable, $name, $data);
    }
}