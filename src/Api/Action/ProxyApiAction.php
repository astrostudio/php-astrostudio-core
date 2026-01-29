<?php
namespace AstroStudio\Core\Api\Action;

use AstroStudio\Core\Api\ApiActionInterface;
use AstroStudio\Core\Api\ApiQueryInterface;
use AstroStudio\Core\Hash;

class ProxyApiAction extends AbstractApiAction
{
    protected ApiActionInterface $action;
    protected array $options;

    public function __construct(ApiActionInterface $action,array $options=[])
    {
        $this->action=$action;
        $this->options=$options;
    }

    public function execute(ApiQueryInterface $query,array $options=[]): mixed
    {
        return $this->action->execute($query, Hash::extend($this->options, $options));
    }
}
