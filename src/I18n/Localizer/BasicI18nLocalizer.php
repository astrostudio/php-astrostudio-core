<?php
namespace AstroStudio\Core\I18n\Localizer;

use AstroStudio\Core\I18n\I18nLanguageInterface;
use AstroStudio\Core\I18n\I18nLocalizerInterface;
use AstroStudio\Core\I18n\Language\BasicI18nLanguage;

class BasicI18nLocalizer implements I18nLocalizerInterface
{
    protected I18nLanguageInterface $language;

    public function __construct(I18nLanguageInterface $language)
    {
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
