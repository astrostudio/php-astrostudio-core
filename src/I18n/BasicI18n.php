<?php
namespace AstroStudio\Core\I18n;

use AstroStudio\Core\I18n\Renderer\DefaultI18nRenderer;

class BasicI18n extends AbstractI18n
{
    protected I18nTranslatorInterface $translator;
    protected I18nFormatterInterface $formatter;
    protected I18nComparatorInterface $comparator;
    protected I18nRendererInterface $renderer;

    public function __construct(
        I18nTranslatorInterface $translator,
        I18nFormatterInterface $formatter,
        I18nComparatorInterface $comparator,
        ?I18nRendererInterface $renderer = null
    ) {
        $this->translator = $translator;
        $this->formatter = $formatter;
        $this->comparator = $comparator;
        $this->renderer = $renderer??new DefaultI18nRenderer();
    }

    public function get(I18nLanguageInterface $language, string $alias, array $values = [], array $options = []): string
    {
        return $this->renderer->render($language, $this->translator->get($language, $alias, $options)??$alias, $values, $options);
    }

    public function format(I18nLanguageInterface $language, mixed $value, string $type, array $options = []): string
    {
        return $this->formatter->format($language, $value, $type, $options);
    }

    public function compare(I18nLanguageInterface $language, string $one, string $two, array $options = []): int
    {
        return $this->comparator->compare($language, $one, $two, $options);
    }
}
