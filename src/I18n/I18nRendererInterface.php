<?php
namespace AstroStudio\Core\I18n;

interface I18nRendererInterface
{
    function render(I18nLanguageInterface $language, string $text, array $values = [], array $options = []): string;
}
