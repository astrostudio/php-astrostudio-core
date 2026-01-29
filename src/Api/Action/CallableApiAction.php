<?php
namespace AstroStudio\Core\Api\Action;

use AstroStudio\Core\Api\ApiQueryInterface;

class CallableApiAction extends AbstractApiAction
{
    protected $callable;

    public function __construct(callable $callable){
        $this->callable=$callable;
    }

    public function execute(ApiQueryInterface $query,array $options=[]): mixed
    {
        return call_user_func($this->callable,$query,$options);
    }
}
