<?php
namespace AstroStudio\Core\Frame;

use AstroStudio\Core\Arrayable\ArrayableInterface;

interface FrameInterface extends ArrayableInterface
{
    function has(string $key): bool;
    function get(array|string|null $key = null, mixed $value = null): mixed;
}