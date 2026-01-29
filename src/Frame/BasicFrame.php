<?php
namespace AstroStudio\Core\Frame;

class BasicFrame extends AbstractFrame
{
    use ArrayFrameTrait;

    public function __construct(array $values = []){
        $this->set($values);
    }
}