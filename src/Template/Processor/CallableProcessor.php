<?php
namespace AstroStudio\Core\Template\Processor;

/**
 * @template T
 * @extends  AbstractProcessor<T>
 */
class CallableProcessor extends AbstractProcessor
{
    /**
     * @var callable(T, mixed[]): void
     */
    protected $callable;

    /**
     * @param callable(T,mixed[]): void $callable
     */
    public function __construct(callable $callable)
    {
        $this->callable = $callable;
    }

    public function process($value, array $options = []): void
    {
        call_user_func($this->callable, $value, $options);
    }
}
