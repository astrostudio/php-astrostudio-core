<?php
namespace AstroStudio\Core\I18n;

class LocaleI18n extends ProxyI18n
{
    /**
     * @var I18nLocaleInterface[]
     */
    protected array $locales;

    /**
     * @param I18nLocaleInterface[] $locales
     */
    public function __construct(array $locales = [], ?I18nInterface $i18n = null, array $options = [])
    {
        parent::__construct($i18n??new IdleI18n(), $options);

        $this->locales = $locales;
    }

    public function get(I18nLanguageInterface $language, string $alias, array $values = [], array $options = []): string
    {
        if(!array_key_exists($language->getKey(), $this->locales)) {
            return parent::get($language, $alias, $values, $options);
        }

        return $this->locales[$language->getKey()]->get($alias, $values, $options);
    }

    public function format(I18nLanguageInterface $language, mixed $value, string $type, array $options = []): string
    {
        if(!array_key_exists($language->getKey(), $this->locales)) {
            return parent::format($language, $value, $type, $options);
        }

        return $this->locales[$language->getKey()]->format($value, $type, $options);
    }

    public function compare(I18nLanguageInterface $language, string $one, string $two, array $options = []): int
    {
        if(!array_key_exists($language->getKey(), $this->locales)) {
            return parent::compare($language, $one, $two, $options);
        }

        return $this->locales[$language->getKey()]->compare($one, $two, $options);
    }
}
