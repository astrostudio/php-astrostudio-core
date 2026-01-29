<?php
namespace AstroStudio\Core\I18n\Language;

use AstroStudio\Core\Frame\ArrayFrameTrait;

class BasicI18nLanguage extends AbstractI18nLanguage
{
    use ArrayFrameTrait;

    protected string $name;

    protected ?string $country;

    public function __construct(string $name, ?string $country = null, array $values = [])
    {
        $this->set($values);
        $this->name = $name;
        $this->country = $country;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }
}
