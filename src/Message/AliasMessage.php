<?php
namespace AstroStudio\Core\Message;

use AstroStudio\Core\Alias\BaseAlias;
use AstroStudio\Core\Text;

class AliasMessage extends BaseAlias implements MessageInterface
{
    public const TEMPLATE = null;

    static public function getTemplate(): string
    {
        return static::TEMPLATE??static::getName();
    }

    public function __construct(array $values = [])
    {
        parent::__construct($values);
    }

    public function getBody(): string
    {
        return Text::render(static::getTemplate(), $this->getValues());
    }

    public function jsonSerialize(): mixed
    {
        return array_merge(
            parent::jsonSerialize(), [
            'body'=>$this->getBody()
            ]
        );
    }
}
