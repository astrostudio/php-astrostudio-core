<?php
namespace AstroStudio\Core\Template\Factory;

/**
 * @template   T
 * @implements FactoryInterface<T>
 */
class CallableSupplier implements FactoryInterface
{
    /**
     * @var callable(): T
     */
    protected $callable;

    /**
     * @var mixed[]
     */
    protected array $args;

    /**
     * @param callable():T $callable
     * @param mixed[]      $args
     */
    public function __construct(callable $callable, array $args = [])
    {
        $this->callable = $callable;
        $this->args = $args;
    }

    public function get(): mixed
    {
        return call_user_func_array($this->callable, $this->args);
    }
}
