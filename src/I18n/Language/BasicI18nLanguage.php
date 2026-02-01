<?php
namespace AstroStudio\Core\I18n\Language;

use AstroStudio\Core\Frame\ArrayFrameTrait;
use AstroStudio\Core\I18n\I18nLanguageInterface;

class BasicI18nLanguage extends AbstractI18nLanguage
{
    use ArrayFrameTrait;

    static public function create(string $key, array $values = []): BasicI18nLanguage
    {
        if(($i = mb_strpos($key, I18nLanguageInterface::SEPARATOR))!== false) {
            $country = mb_substr($key, $i+mb_strlen(I18nLanguageInterface::SEPARATOR));
            $country = mb_strlen($country)> 0?$country: null;

            return new BasicI18nLanguage(mb_substr($key, 0, $i), $country, $values);
        }

        return new BasicI18nLanguage($key, null, $values);
    }


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
