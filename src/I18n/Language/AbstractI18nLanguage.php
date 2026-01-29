<?php
namespace AstroStudio\Core\I18n\Language;

use AstroStudio\Core\Frame\AbstractFrame;
use AstroStudio\Core\I18n\I18nLanguageInterface;

abstract class AbstractI18nLanguage extends AbstractFrame implements I18nLanguageInterface
{
    public function getKey(): string
    {
        $key = $this->getName();

        if(!is_null($country = $this->getCountry())){
            $key .= self::SEPARATOR.$country;
        }

        return $key;
    }
}