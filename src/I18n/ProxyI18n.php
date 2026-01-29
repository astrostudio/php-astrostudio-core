<?php
namespace AstroStudio\Core\I18n;

use AstroStudio\Core\Hash;

class ProxyI18n extends AbstractI18n
{
    protected I18nInterface $i18n;
    protected array $options;

    public function __construct(I18nInterface $i18n, array $options = [])
    {
        $this->i18n = $i18n;
        $this->options = $options;
    }

    public function get(I18nLanguageInterface $language, string $alias, array $values = [], array $options = []): string
    {
        return $this->i18n->get($language, $alias, $values, Hash::extend($this->options, $options));
    }

    public function format(I18nLanguageInterface $language, mixed $value, string $type, array $options = []): string
    {
        return $this->i18n->format($language, $value, $type, Hash::extend($this->options, $options));
    }

    public function compare(I18nLanguageInterface $language, string $one, string $two, array $options = []): int
    {
        return $this->i18n->compare($language, $one, $two, Hash::extend($this->options, $options));
    }
}
