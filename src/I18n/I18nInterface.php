<?php
namespace AstroStudio\Core\I18n;

interface I18nInterface
{
    /**
     * @param string              $alias
     * @param array<string,mixed> $values
     * @param mixed[]             $options
     *
     * @return string
     */
    function get(I18nLanguageInterface $language, string $alias, array $values = [], array $options = []): string;

    /**
     * @param mixed   $value
     * @param string  $type
     * @param mixed[] $options
     *
     * @return string
     */
    function format(I18nLanguageInterface $language, mixed $value, string $type, array $options = []): string;

    /**
     * @param string  $one
     * @param string  $two
     * @param mixed[] $options
     *
     * @return int
     */
    function compare(I18nLanguageInterface $language, string $one, string $two, array $options = []): int;

    /**
     * @param string[] $array
     * @param mixed[]  $options
     *
     * @return void
     */
    function sort(I18nLanguageInterface $language, array &$array = [], array $options = []): void;
}
