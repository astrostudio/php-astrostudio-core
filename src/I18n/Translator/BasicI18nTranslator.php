<?php
namespace AstroStudio\Core\I18n\Translator;

use AstroStudio\Core\I18n\I18nLanguageInterface;
use AstroStudio\Core\I18n\I18nTranslatorInterface;

class BasicI18nTranslator implements I18nTranslatorInterface
{
    protected array $aliases = [];

    public function __construct(array $aliases = [])
    {
        $this->set($aliases);
    }

    public function get(I18nLanguageInterface $language, string $alias, array $options = []): ?string
    {
        if(!array_key_exists($alias, $this->aliases)) {
            return null;
        }

        if(!array_key_exists($language->getKey(), $this->aliases[$alias])) {
            return null;
        }

        return $this->aliases[$alias][$language->getKey()];
    }

    public function set(array|string|null $alias = null, array|string|null $language = null, ?string $text = null): void
    {
        if(is_null($alias)) {
            $this->aliases = [];

            return;
        }

        if(is_array($alias)) {
            foreach($alias as $a=>$texts){
                if(!is_array($texts)) {
                    continue;
                }

                $this->set($a, $texts);
            }

            return;
        }

        if(is_null($language)) {
            unset($this->aliases[$alias]);

            return;
        }

        if(is_array($language)) {
            foreach($language as $l=>$text){
                $this->set($alias, $l, $text);
            }

            return;
        }


        if(is_null($text)) {
            unset($this->aliases[$alias][$language]);

            return;
        }

        if(!array_key_exists($alias, $this->aliases)) {
            $this->aliases[$alias] = [];
        }

        $this->aliases[$alias][$language] = $text;
    }

    public function loadAsJson(string $path): void
    {
        $this->set(json_decode(file_get_contents($path), true));
    }

    public function loadAsTsv(string $path): void
    {
        $file = fopen($path, "r");

        while(!feof($file)){
            $items = fgetcsv($file, null, "\t");

            if(empty($items[0])) {
                continue;
            }

            if(empty($items[1])) {
                continue;
            }

            if(empty($items[2])) {
                continue;
            }

            $this->set($items[0], $items[1], $items[2]);
        }
    }
}
