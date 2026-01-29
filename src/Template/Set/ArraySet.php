<?php
namespace AstroStudio\Core\Template\Set;

use AstroStudio\Core\Template\Processor\ProcessorInterface;

/**
 * @template T
 * @extends  AbstractSet<T>
 */
class ArraySet extends AbstractSet
{
    /**
     * @var T[]
     */
    protected array $items;

    /**
     * @param T[] $items
     */
    public function __construct(array $items = [])
    {
        $this->items = $items;
    }

    public function each(ProcessorInterface $processor, array $options = []): void
    {
        foreach($this->items as $item){
            $processor->process($item, $options);
        }
    }

    public function count(array $options = []): int
    {
        return count($this->items);
    }
}
