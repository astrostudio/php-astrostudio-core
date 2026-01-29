<?php
namespace AstroStudio\Core\I18n;

interface I18nLocalizerInterface
{
    function get(): I18nLanguageInterface;
}
