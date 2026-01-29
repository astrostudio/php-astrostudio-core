<?php
namespace AstroStudio\Core\Message;

use JsonSerializable;

interface MessageInterface extends JsonSerializable
{
    function getBody(): string;
}
