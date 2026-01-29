<?php
namespace AstroStudio\Core\Alias;

use JsonSerializable;

interface AliasInterface extends JsonSerializable
{
    static public function getName(): string;

    public function getValues(): array;
}
