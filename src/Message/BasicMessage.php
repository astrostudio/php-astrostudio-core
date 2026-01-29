<?php
namespace AstroStudio\Core\Message;

class BasicMessage extends AbstractMessage
{
    protected string $body;

    public function __construct(string $body)
    {
        $this->body = $body;
    }

    public function getBody(): string
    {
        return $this->body;
    }
}
