<?php
namespace AstroStudio\Core\Message;

use AstroStudio\Core\Alias\AbstractAlias;

abstract class AbstractMessage implements MessageInterface
{
    public function jsonSerialize(): mixed
    {
        return [
            'body'=>$this->getBody()
        ];
    }
}