<?php
namespace AstroStudio\Core\Template\Creator;

/**
 * @template T
 */
interface CreatorInterface
{
    /**
     * @param mixed[] $data
     *
     * @return T
     */
    public function get(array $data = []): mixed;
}