<?php
namespace Base;

use AstroStudio\Core\Hash;
use Exception;

class View
{
    protected array $stack=[];
    protected string $templates;

    protected function stackOffset()
    {
        $stackSize=count($this->stack);

        if($stackSize==0) {
            throw new Exception('View::stackOffset(): No render stack');
        }

        return $stackSize-1;
    }

    protected function begin(string $name,int $where=0): void
    {
        $stackOffset=$this->stackOffset();

        if(!ob_start()) {
            throw new Exception('View::begin(): ob_start() error');
        }

        $this->stack[$stackOffset]['blockStack'][] = [$name => $where];
    }

    public function __construct(?string $templates=null)
    {
        $this->templates=$templates??dirname(__FILE__);

        $this->stack[] = [
            'template'   => [],
            'block'      => [],
            'blockStack' => []
        ];
    }

    public function start(string $name): void
    {
        $this->begin($name, 0);
    }

    public function append(string $name,string $body=null):void
    {
        if(isset($body)) {
            $this->begin($name, 1);
            echo $body;
            $this->end();

            return;
        }

        $this->begin($name, 1);
    }

    public function prepend(string $name,string $body=null):void
    {
        if(isset($body)) {
            $this->begin($name, -1);
            echo $body;
            $this->end();

            return;
        }

        $this->begin($name, -1);
    }

    public function end():void
    {
        $stackOffset=$this->stackOffset();

        if(empty($this->stack[$stackOffset]['blockStack'])) {
            throw new Exception('View::end(): To many ends');
        }

        $blockItem=array_pop($this->stack[$stackOffset]['blockStack']);

        foreach($blockItem as $name=>$where){
            if($where==0) {
                $this->stack[$stackOffset]['block'][$name]=ob_get_clean();
            }
            else {
                $body=$this->stack[$stackOffset]['block'][$name]??'';

                if($where>0) {
                    $this->stack[$stackOffset]['block'][$name] = $body . ob_get_clean();
                }
                else {
                    $this->stack[$stackOffset]['block'][$name] = ob_get_clean().$body;
                }
            }

            break;
        }
    }

    public function assign($name,string $body=''):void
    {
        if(is_array($name)) {
            foreach($name as $n=>$b){
                $this->assign($n, $b);
            }

            return;
        }

        $this->start($name);
        echo $body;
        $this->end();
    }

    public function has(string $name):bool
    {
        $stackOffset=$this->stackOffset();

        return isset($this->_stack[$stackOffset]['block'][$name]);
    }

    public function fetch(array|string $name,string $value=''):array|string
    {
        if(is_array($name)) {
            $fetch=[];

            foreach($name as $key=>$value){
                if(is_int($key)) {
                    $fetch[$value] = $this->fetch($value);
                }
                else {
                    $fetch[$key]=$this->fetch($key, $value);
                }
            }

            return $fetch;
        }

        $stackOffset=$this->stackOffset();

        return $this->stack[$stackOffset]['block'][$name]??$value;
    }


    public function extend(string $name,array $params=[]):void
    {
        $stackOffset=$this->stackOffset();

        array_push($this->stack[$stackOffset]['template'], [$name=>$params]);
    }

    public function template(string $name):string
    {
        return str_replace('/', DIRECTORY_SEPARATOR, $this->templates.'/'.$name.'.php');
    }

    protected function extract(string $name,array $params=[]):string
    {
        $_template=$this->template($name);

        if(!is_file($_template)) {
            throw new Exception('View::_extract(): No template "'.$_template.'"');
        }

        $_compact=compact(array_keys(get_defined_vars()));
        extract($params);
        ob_start();
        include $_template;
        $output=ob_get_clean();
        extract($_compact);

        return $output;
    }

    public function exists(string $name):bool
    {
        $_template=$this->template($name);

        if(!is_file($_template)) {
            return false;
        }

        return true;
    }

    public function render(string $name,array $params=[]):string
    {
        $this->stack[] = [
            'template'   => [],
            'block'      => [],
            'blockStack' => []
        ];

        $this->assign('content', $this->extract($name, $params));

        $stackOffset=$this->stackOffset();

        while(!empty($this->stack[$stackOffset]['template'])){
            $item=array_pop($this->stack[$stackOffset]['template']);

            foreach($item as $template=>$subParams){
                $params=Hash::extend($params, $subParams);
                $this->assign('content', $this->extract($template, $params));

                break;
            }
        }

        $content=$this->fetch('content');

        array_pop($this->stack);

        return $content;
    }

    static public function get(string $path):string
    {
        if(!is_file($path)) {
            throw new Exception('View::get(): No content "'.$path.'"');
        }

        return file_get_contents($path);
    }

}
