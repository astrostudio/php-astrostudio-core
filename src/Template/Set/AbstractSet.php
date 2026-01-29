<?php
namespace AstroStudio\Core\Template\Set;

use AstroStudio\Core\Template\Mapper\MapperInterface;
use AstroStudio\Core\Template\Processor\CallableProcessor;

/**
 * @template   T
 * @implements SetInterface<T>
 */
abstract class AbstractSet implements SetInterface
{
    public function count(array $options = []): int
    {
        $count = 0;

        /**
         * @var CallableProcessor<T>
         */
        $processor = new CallableProcessor(
            function () use (&$count) {
                ++$count;
            }
        );

        $this->each($processor, $options);

        return $count;
    }

    public function map(MapperInterface $mapper, array $options = []): array
    {
        $map = [];

        $processor = new CallableProcessor(function(mixed $value, array $options = []) use ($mapper,&$map){
            $m = $mapper->map($value, $options);

            foreach($m as $k=>$v){
                if(is_int($k)){
                    $map[] = $v;

                    continue;
                }

                $map[$k] = $v;
            }
        });

        $this->each($processor, $options);

        return $map;
    }
}
