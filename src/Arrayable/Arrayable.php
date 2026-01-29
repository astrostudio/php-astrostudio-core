<?php
namespace AstroStudio\Core\Arrayable;

class Arrayable
{
    static public function reset(array $array = [], int $flags = 0, int $depth = 512): array
    {
        return json_decode(json_encode($array, $flags, $depth), true, $depth, $flags);
    }
}
