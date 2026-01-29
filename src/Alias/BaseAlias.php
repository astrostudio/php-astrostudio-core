<?php
namespace AstroStudio\Core\Alias;

class BaseAlias extends AbstractAlias
{
    public const ALIAS = null;

    static public function getName(): string
    {
        return static::ALIAS??static::class;
    }

    protected array $values = [];

    public function __construct(array $values = [])
    {
        $this->values = $values;
    }

    public function getValues(): array
    {
        return $this->values;
    }
}
