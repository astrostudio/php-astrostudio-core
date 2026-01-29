<?php
namespace AstroStudio\Core\I18n\Locale;

interface I18nLocaleTranslatorInterface
{
    function get(string $alias, array $options = []): ?string;
}