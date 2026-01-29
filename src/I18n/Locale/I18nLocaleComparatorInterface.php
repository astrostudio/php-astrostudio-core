<?php
namespace AstroStudio\Core\I18\Locale;

interface I18nLocaleComparatorInterface
{
    function compare(string $one, string $two, array $options = []): int;
}