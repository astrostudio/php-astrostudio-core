<?php
namespace AstroStudio\Core\I18n\Localizer;

use AstroStudio\Core\I18n\I18nLanguageInterface;
use AstroStudio\Core\I18n\I18nLocalizerInterface;
use AstroStudio\Core\I18n\Language\BasicI18nLanguage;

class BasicI18nLocalizer implements I18nLocalizerInterface
{
    static public function create(string $key, array $values = []): BasicI18nLanguage
    {
        if(($i = mb_strpos($key, I18nLanguageInterface::SEPARATOR))!== false){
            $country = mb_substr($key, $i+mb_strlen(I18nLanguageInterface::SEPARATOR));
            $country = mb_strlen($country)> 0?$country: null;

            return new BasicI18nLanguage(mb_substr(0, $i), $country, $values);
        }

        return new BasicI18nLanguage($key, null, $values);
    }

    protected I18nLanguageInterface $language;

    public function __construct(I18nLanguageInterface $language){
        $this->language = $language;
    }

    public function get(): I18nLanguageInterface
    {
        return $this->language;
    }

    public function set(I18nLanguageInterface $language): void
    {
        $this->language = $language;
    }

}