<?php
namespace AstroStudio\Core\Api\Query;

use AstroStudio\Core\Hash;

class BasicApiQuery extends AbstractApiQuery
{
    protected array $data;

    public function __construct(array $data=[])
    {
        $this->data=$data;
    }

    public function get(array|string|null $name=null, mixed $value = null): mixed
    {
        if(is_null($name)) {
            return $this->data;
        }

        if(is_array($name)) {
            $data = [];

            foreach($name as $n=>$v){
                if(is_int($n)) {
                    Hash::attach($data, $v, $this->data[$v]??$value);

                    continue;
                }

                Hash::attach($data, $n, $this->data[$n]??$v);
            }

            return $data;
        }

        return $this->data[$name]??$value;
    }
}
