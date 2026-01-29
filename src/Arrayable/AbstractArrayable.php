<?php
namespace AstroStudio\Core\Arrayable;

abstract class AbstractArrayable implements ArrayableInterface
{
    public function jsonSerialize(): mixed
    {
        return $this->toArray();
    }
}