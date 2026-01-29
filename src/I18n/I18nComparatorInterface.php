<?php
namespace AstroStudio\Core\I18n;

interface I18nComparatorInterface
{
    function compare(I18nLanguageInterface $language, string $one, string $two, array $options = []): int;
}