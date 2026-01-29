<?php
namespace AstroStudio\Core\I18n;

interface I18nLocaleInterface
{
    function get(string $alias, array $values = [], array $options = []): string;

    function format(mixed $value, string $type, array $options = []): string;

    function compare(string $one, string $two, array $options = []): int;

}