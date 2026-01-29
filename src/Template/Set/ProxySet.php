<?php
namespace AstroStudio\Core\Template\Set;

use AstroStudio\Core\Hash;
use AstroStudio\Core\Template\Processor\ProcessorInterface;

/**
 * @template T
 * @extends  AbstractSet<T>
 */
class ProxySet extends AbstractSet
{
    /**
     * @var SetInterface<T>
     */
    protected SetInterface $set;
    /**
     * @var mixed[]
     */
    protected array $options;

    /**
     * @param SetInterface<T> $set
     * @param mixed[]         $options
     */
    public function __construct(SetInterface $set, array $options = [])
    {
        $this->set = $set;
        $this->options = $options;
    }

    public function each(ProcessorInterface $processor, array $options = []): void
    {
        $this->set->each($processor, Hash::extend($this->options, $options));
    }
}
