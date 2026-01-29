<?php
namespace AstroStudio\Core\Template\Processor;

/**
 * @template T
 * @extends  AbstractProcessor<T>
 */
class LayerProcessor extends AbstractProcessor
{
    /**
     * @var ProcessorInterface<T>[]
     */
    protected array $processors;

    /**
     * @param ProcessorInterface<T>[] $processors
     */
    public function __construct(array $processors = [])
    {
        $this->processors = $processors;
    }

    public function process($value, array $options = []): void
    {
        foreach($this->processors as $processor){
            $processor->process($value, $options);
        }
    }
}
