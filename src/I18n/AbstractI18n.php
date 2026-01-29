<?php
namespace AstroStudio\Core\I18n;

abstract class AbstractI18n implements I18nInterface
{
    public function sort(I18nLanguageInterface $language, array &$array = [], array $options = []): void
    {
        usort($array, function(string $one, string $two) use ($language, $options){
            return $this->compare($language, $one, $two, $options);
        });
    }
}