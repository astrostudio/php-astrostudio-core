<?php
namespace AstroStudio\Core\I18n\Locale;

interface I18nLocaleRendererInterface
{
    function render(string $text, array $values = [], array $options = []): string;
}
