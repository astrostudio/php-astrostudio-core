<?php
namespace AstroStudio\Core\Frame;

use AstroStudio\Core\Arrayable\AbstractArrayable;

abstract class AbstractFrame extends AbstractArrayable implements FrameInterface
{
    public function toArray(): array
    {
        return $this->get();
    }
}