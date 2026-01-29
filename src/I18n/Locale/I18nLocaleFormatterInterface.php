<?php
namespace AstroStudio\Core\I18n\Locale;

interface I18nLocaleFormatterInterface
{
    function format(mixed $value, string $type, array $options = []): string;
}