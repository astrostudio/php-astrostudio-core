<?php
namespace AstroStudio\Core\I18n;

interface I18nFormatterInterface
{
    function format(I18nLanguageInterface $language, mixed $value, string $type, array $options = []): string;
}