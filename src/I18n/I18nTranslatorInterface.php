<?php
namespace AstroStudio\Core\I18n;

interface I18nTranslatorInterface
{
    function get(I18nLanguageInterface $language, string $alias, array $options = []): ?string;
}
