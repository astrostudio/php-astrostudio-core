<?php
namespace AstroStudio\Core\I18n;

class IdleI18n extends AbstractI18n
{
    public function get(I18nLanguageInterface $language, string $alias, array $values = [], array $options = []): string
    {
        return $alias;
    }

    public function format(I18nLanguageInterface $language, mixed $value, string $type, array $options = []): string
    {
        return strval($value);
    }

    public function compare(I18nLanguageInterface $language, string $one, string $two, array $options = []): int
    {
        return strcmp($one, $two);
    }
}
