<?php
namespace AstroStudio\Core\Api\Action;

use AstroStudio\Core\Api\ApiActionInterface;
use AstroStudio\Core\Api\ApiQueryInterface;
use AstroStudio\Core\Hash;

class LayerApiAction extends AbstractApiAction
{
    const KEY='key';
    const SEPARATOR=',';

    /**
     * @var ApiActionInterface[]
     */
    protected array $actions=[];
    protected string $key;
    protected string $separator;

    public function __construct(array $actions=[],$key=self::KEY,string $separator=self::SEPARATOR)
    {
        $this->key=$key;
        $this->separator=$separator;

        $this->setAction($actions);
    }

    public function execute(ApiQueryInterface $query,array $options=[]): mixed
    {
        $keys=$query->get($this->key);

        if(isset($keys)) {
            $keys=is_array($keys)?$keys:explode($this->separator, $keys);
        }
        else {
            $keys=array_keys($this->actions);
        }

        $result=[];

        foreach($keys as $key){
            if(!($action=$this->getAction($key))) {
                continue;
            }

            $result[$key]=$action->execute($query, $options);
        }

        return $result;
    }

    public function getAction(string $key):?ApiActionInterface
    {
        return $this->actions[$key]??null;
    }

    public function setAction(array|string|null $key = null,?ApiActionInterface $action=null,int $offset=null): void
    {
        if(is_null($key)) {
            $this->actions = [];

            return;
        }

        if(is_array($key)) {
            foreach($key as $k=>$a){
                $this->setAction($k, $a);
            }

            return;
        }

        unset($this->actions[$key]);

        if($action) {
            $this->actions=Hash::insert($this->actions, $key, $action, $offset);
        }
    }

}
