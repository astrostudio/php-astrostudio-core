<?php
namespace AstroStudio\Core\Template\Creator;

/**
 * @template T
 * @implements CreatorInterface<T>
 */
class CallableBuilder implements CreatorInterface
{
    /**
     * @var callable(array):T|null
     */
    protected $callable;

    /**
     * @param callable(array): T $callable
     */
    public function __construct(callable $callable){
        $this->callable = $callable;
    }

    public function get(array $data = []): mixed
    {
        return call_user_func($this->callable,$data);
    }
}