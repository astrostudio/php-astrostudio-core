<?php
namespace AstroStudio\Core\Api;

interface ApiQueryInterface
{
    function get(array|string|null $name=null,mixed $value=null):mixed;
}
