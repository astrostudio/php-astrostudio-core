<?php
namespace AstroStudio\Core\I18n;

use AstroStudio\Core\I18n\Language\BasicI18nLanguage;
use AstroStudio\Core\I18n\Localizer\BasicI18nLocalizer;

class I18n
{
    static private ?I18nInterface $instance = null;

    static private ?I18nLocalizerInterface $localizer = null;

    static public function getInstance(): I18nInterface
    {
        if(!self::$instance) {
            self::$instance = new IdleI18n();
        }

        return self::$instance;
    }

    static public function setInstance(?I18nInterface $i18n = null): void
    {
        self::$instance = $i18n;
    }

    static public function getLocalizer(): I18nLocalizerInterface
    {
        if(!self::$localizer) {
            self::$localizer = new BasicI18nLocalizer(new BasicI18nLanguage('pl'));
        }

        return self::$localizer;
    }

    static public function setLocalizer(?I18nLocalizerInterface $localizer = null): void
    {
        self::$localizer = $localizer;
    }

    static public function get(string $alias, array $values = [], ?I18nLanguageInterface $language = null, array $options = []): string
    {
        return self::getInstance()->get($language??self::getLocalizer()->get(), $alias, $values, $options);
    }

    static public function format(mixed $value, string $type, ?I18nLanguageInterface $language = null, array $options = []): string
    {
        return self::getInstance()->format($language??self::getLocalizer()->get(), $value, $type, $options);
    }

    static public function compare(string $one, string $two, ?I18nLanguageInterface $language = null, array $options = []): int
    {
        return self::getInstance()->compare($language??self::getLocalizer()->get(), $one, $two, $options);
    }

    static public function sort(array &$array = [], ?I18nLanguageInterface $language = null, array $options = []): void
    {
        self::getInstance()->sort($language??self::getLocalizer()->get(), $array, $options);
    }

}
