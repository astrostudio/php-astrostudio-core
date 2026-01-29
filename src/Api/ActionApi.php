<?php
namespace AstroStudio\Core\Api;

class ActionApi extends AbstractApi
{
    /**
     * @var ApiActionInterface[]
     */
    protected array $actions;

    /**
     * @param ApiActionInterface[] $actions
     */
    public function __construct(array $actions=[])
    {
        $this->setAction($actions);
    }

    public function execute(string $name,ApiQueryInterface $query,array $options=[]): mixed
    {
        $action=$this->getAction($name);

        if(!$action) {
            throw new ApiException($this, 'No action "'.$name.'"');
        }

        return $action->execute($query, $options);
    }

    public function getAction(string $name):?ApiActionInterface
    {
        return $this->actions[$name]??null;
    }

    public function setAction(array|string|null $name=null,?ApiActionInterface $action=null): void
    {
        if(is_null($name)) {
            $this->actions=[];

            return;
        }

        if(is_array($name)) {
            foreach($name as $n=>$a){
                $this->setAction($n, $a);
            }

            return;
        }

        unset($this->actions[$name]);

        if($action) {
            $this->actions[$name]=$action;
        }
    }

}
