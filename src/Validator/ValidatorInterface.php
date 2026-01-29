<?php
namespace AstroStudio\Core\Validator;

use AstroStudio\Core\Alias\AliasInterface;

interface ValidatorInterface
{
    /**
     * @param mixed $value
     * @param mixed[] $options
     *
     * @return AliasInterface[]
     */
    function validate(mixed $value, array $options = []): array;
}