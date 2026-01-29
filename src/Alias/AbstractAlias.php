<?php
namespace AstroStudio\Core\Alias;

abstract class AbstractAlias implements AliasInterface
{
    public function jsonSerialize(): mixed
    {
        return [
            'name' => $this->getName(),
            'values'=> $this->getValues()
        ];
    }
}