<?php
namespace AstroStudio\Core\Api\Query;


use AstroStudio\Core\Api\ApiQueryInterface;

class ProxyApiQuery extends AbstractApiQuery
{
    protected ApiQueryInterface $query;

    public function __construct(ApiQueryInterface $query){
        $this->query=$query;
    }

    public function get(array|string|null $name=null, mixed $value = null): mixed
    {
        return $this->query?$this->query->get($name,$value):$value;
    }
}