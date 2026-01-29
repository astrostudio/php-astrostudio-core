<?php
namespace AstroStudio\Core\Api;

use AstroStudio\Core\Hash;

class ProxyApi extends AbstractApi
{
    protected ApiInterface $_api;
    protected array $options;

    public function __construct(ApiInterface $api,array $options=[]){
        $this->api=$api;
        $this->options=$options;
    }

    public function execute(string $name,ApiQueryInterface $query,array $options=[]): mixed
    {
        return $this->api->execute($name,$query,Hash::extend($this->options, $options));
    }
}
