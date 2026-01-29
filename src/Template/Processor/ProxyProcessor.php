<?php
namespace AstroStudio\Core\Template\Processor;

/**
 * @template T
 * @extends  AbstractProcessor<T>
 */
class ProxyProcessor extends AbstractProcessor
{
    /**
     * @var ProcessorInterface<T>
     */
    protected ProcessorInterface $processor;

    /**
     * @var mixed[]
     */
    protected array $options;

    /**
     * @param ProcessorInterface<T> $processor
     * @param mixed[]               $options
     */
    public function __construct(ProcessorInterface $processor, array $options = [])
    {
        $this->processor = $processor;
        $this->options = $options;
    }

    public function process($value, array $options = []): void
    {
        $this->processor->process($value, array_merge($this->options, $options));
    }

    public function processMany(array $values = [], array $options = []): void
    {
        $this->processMany($values, array_merge($this->options, $options));
    }
}
