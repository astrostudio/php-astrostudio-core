<?php
namespace AstroStudio\Core\I18n\Renderer;

use AstroStudio\Core\I18n\I18nLanguageInterface;
use AstroStudio\Core\I18n\I18nRendererInterface;
use AstroStudio\Core\Text;

class DefaultI18nRenderer implements I18nRendererInterface
{
    public function render(
        I18nLanguageInterface $language,
        string $text,
        array $values = [],
        array $options = []
    ): string {
        return Text::render($text, $values);
    }
}
