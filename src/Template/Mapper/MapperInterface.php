<?php
namespace AstroStudio\Core\Template\Mapper;

/**
 * @template T
 */
interface MapperInterface
{
    /**
     * @param T       $value
     * @param mixed[] $options
     *
     * @return mixed[]
     */
    public function map(mixed $value, array $options = []): array;
}
