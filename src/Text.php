<?php

namespace AstroStudio\Core;

class Text
{
    public const PATTERN = '/{{([a-zA-Z0-9_\-]+)}}/';

    /**
     * @param string $base
     * @param string $text
     * @param string $prefix
     * @param string $suffix
     *
     * @return string
     */
    public static function glue(string $base, string $text, string $prefix=', ', string $suffix=''): string
    {
        if(empty($text)) {
            return $base;
        }

        return($base.$prefix.$text.$suffix);
    }

    /**
     * @param string $text
     *
     * @return mixed[]
     */
    public static function patterns(string $text): array
    {
        preg_match_all(self::PATTERN, $text, $matches);

        if (empty($matches[1])) {
            return [];
        }

        return $matches[1];
    }

    /**
     * @param string  $string
     * @param mixed[] $values
     *
     * @return string
     */
    public static function render(string $string = '', array $values = []): string
    {
        foreach ($values as $key => $value) {
            $string = str_replace('{{'.$key.'}}', $value, $string);
        }

        return $string;
    }

    public static function renderSet(string $input, array $valueSet=[]): array
    {
        $output=[];

        foreach($valueSet as $values) {
            $output[]=self::render($input, $values);
        }

        return($output);
    }
    public static function disabiguate(string $string, string $suffix = ''): string
    {
        $patterns = Text::patterns($string);

        foreach ($patterns as $pattern) {
            $string = str_replace('{{'.$pattern.'}}', $pattern.$suffix, $string);
        }

        return $string;
    }

    public static function empty(string $string):bool
    {
        return empty(trim($string));
    }

    public static function prefixed(string $name,string $prefix=''):bool
    {
        return mb_substr($name, 0, mb_strlen($prefix))===$prefix;
    }

    public static function suffix(string $name,string $prefix=''):string
    {
        if(!self::prefixed($name, $prefix)) {
            return '';
        }

        return mb_substr($name, mb_strlen($prefix));
    }
}
