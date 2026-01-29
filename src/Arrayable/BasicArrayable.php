<?php
namespace AstroStudio\Core\Arrayable;

class BasicArrayable extends AbstractArrayable
{
    protected array $array;

    public function __construct(array $array = [])
    {
        $this->array = $array;
    }

    public function toArray(): array
    {
        return $this->array;
    }
}
