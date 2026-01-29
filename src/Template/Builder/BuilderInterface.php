<?php
namespace AstroStudio\Core\Template\Builder;

/**
 * @template T
 */
interface BuilderInterface
{
    /**
     * @param string  $name
     * @param mixed[] $data
     *
     * @return T|null
     */
    public function get(string $name, array $data = []): mixed;
}
