<?php
namespace AstroStudio\Core\Arrayable;

use JsonSerializable;

interface ArrayableInterface extends JsonSerializable
{
    public function toArray(): array;
}
