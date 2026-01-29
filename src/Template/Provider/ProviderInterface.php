<?php
namespace AstroStudio\Core\Template\Provider;

/**
 * @template T
 */
interface ProviderInterface
{
    /**
     * @param string $name
     *
     * @return T|null
     */
    public function get(string $name): mixed;
}
