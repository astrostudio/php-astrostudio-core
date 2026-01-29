<?php
namespace AstroStudio\Core\I18n;

use AstroStudio\Core\Frame\FrameInterface;

interface I18nLanguageInterface extends FrameInterface
{
    public const SEPARATOR = '-';

    public function getKey(): string;

    public function getName(): string;

    public function getCountry(): ?string;

}
