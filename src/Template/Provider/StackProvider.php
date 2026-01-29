<?php
namespace AstroStudio\Core\Template\Provider;

/**
 * @template T
 * @implements ProviderInterface<T>
 */
class StackProvider implements ProviderInterface
{
    /**
     * @var ProviderInterface<T>[]
     */
    protected array $providers;
    /**
     * @var mixed[]
     */
    protected ?array $keys;

    /**
     * @param ProviderInterface<T>[]      $providers
     * @param mixed[] $keys
     */
    public function __construct(array $providers = [], ?array $keys = null){
        $this->providers = $providers;
        $this->keys = $keys;
    }

    public function get(string $name): mixed
    {
        $keys = $this->keys??array_keys($this->providers);

        foreach($keys as $key){
            if(!array_key_exists($key, $this->providers)){
                continue;
            }

            if(!is_null($value = $this->providers[$key]->get($name))){
                return $value;
            }
        }

        return null;
    }
}