<?php
namespace AstroStudio\Core\Api;

class PrefixApi extends AbstractApi
{
    /**
     * @var ApiInterface[] 
     */
    protected array $apis=[];

    /**
     * @param ApiInterface[] $apis
     */
    public function __construct(array $apis=[])
    {
        $this->setApi($apis);
    }

    public function execute(string $name,ApiQueryInterface $query,array $options=[]): mixed
    {
        foreach($this->apis as $prefix=>$api){
            if(mb_substr($name, 0, mb_strlen($prefix))==$prefix) {
                return $api->execute(mb_substr($name, mb_strlen($prefix)), $query, $options);
            }
        }

        throw new ApiException($this, 'Name "'.$name.'" not found');
    }

    public function setApi(array|string|null $prefix=null,ApiInterface $api=null) : void
    {
        if(is_null($prefix)) {
            $this->apis=[];

            return;
        }

        if(is_array($prefix)) {
            foreach($prefix as $p=>$a){
                $this->setApi($p, $a);
            }

            return;
        }

        unset($this->apis[$prefix]);

        if($api) {
            $this->apis[$prefix]=$api;
        }
    }
}
