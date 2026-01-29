<?php
namespace AstroStudio\Core\Frame;

class ProxyFrame extends AbstractFrame
{
    protected FrameInterface $frame;

    public function __construct(FrameInterface $frame){
        $this->frame = $frame;
    }

    function has(string $key): bool
    {
        return $this->frame->has($key);
    }

    function get(array|string|null $key = null, mixed $value = null): mixed
    {
        return $this->frame->get($key, $value);
    }
}