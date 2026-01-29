<?php
namespace AstroStudio\Core\Api;

class ObjectApi extends AbstractApi
{
    protected array $methods=[];

    public function __construct(array $methods=[]){
        $this->_methods=[];

        foreach($methods as $key=>$value){
            if(is_int($key)){
                $this->methods[$value]=$value;
            }
            else {
                $this->methods[$key]=$value;
            }
        }
    }

    public function execute(string $name,ApiQueryInterface $query,array $options=[]): mixed{
        if(empty($this->methods[$name])){
            throw new ApiException($this,'ObjectApi::execute(): No method "'.$name.'"');
        }

        $method=$this->methods[$name]??$name;

        if(!method_exists($this,$method)){
            throw new ApiException($this,'ObjectApi::execute(): No method "'.$method.'"');
        }

        return($this->$method($query,$options));
    }
}
