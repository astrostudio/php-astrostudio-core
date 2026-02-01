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

    static public function language(null|string|I18nLanguageInterface $language = null): I18nLanguageInterface
    {
        if(is_null($language)) {
            return self::getLocalizer()->get();
        }

        if(is_string($language)) {
            return BasicI18nLanguage::create($language);
        }

        return $language;
    }

    static public function get(string $alias, array $values = [], null|string|I18nLanguageInterface $language = null, array $options = []): string
    {
        return self::getInstance()->get(self::language($language), $alias, $values, $options);
    }

    static public function format(mixed $value, string $type, null|string|I18nLanguageInterface $language = null, array $options = []): string
    {
        return self::getInstance()->format(self::language($language), $value, $type, $options);
    }

    static public function compare(string $one, string $two, null|string|I18nLanguageInterface $language = null, array $options = []): int
    {
        return self::getInstance()->compare(self::language($language), $one, $two, $options);
    }

    static public function sort(array &$array = [], null|string|I18nLanguageInterface $language = null, array $options = []): void
    {
        self::getInstance()->sort(self::language($language), $array, $options);
    }

    static public function translateHash(array $hash = [], string $prefix = '', bool $keys = false, null|string|I18nLanguageInterface $language = null): array
    {
        $newHash = [];

        foreach($hash as $key=>$value){
            $newKey = $keys? I18n::get($prefix.$key, [], self::language($language)): $key;

            if(is_array($value)) {
                $newHash[$newKey] = self::translateHash($value, $prefix, $keys, $language);

                continue;
            }

            if(is_string($value)) {
                $newHash[$newKey] = self::get($value, [], self::language($language));

                continue;
            }

            $newHash[$newKey] = $value;
        }

        return $newHash;
    }

}
