<?php
namespace Base;

use Exception;

class XML
{

    static public function mergeAttrs():array
    {
        $args=func_get_args();
        $attrs=[];

        foreach($args as $arg){
            if(!is_array($arg)) {
                continue;
            }

            foreach($arg as $name=>$value){
                $attrs[$name]=$value;
            }
        }

        return($attrs);
    }

    protected array $stack = [];
    protected int $indent;
    protected string $spaces;
    protected string $caret;

    public function __construct(int $indent=0,string $spaces='    ',string $caret="\n")
    {
        $this->indent=$indent;
        $this->spaces=$spaces;
        $this->caret=$caret;
    }

    public function attrs(array $attrs=[]):string
    {
        $output='';

        foreach($attrs as $name=>$value){
            $output.=' '.$name.'="'.$value.'"';
        }

        return $output;
    }

    public function indent():string
    {
        return $this->indent>0?str_repeat($this->spaces, $this->indent):'';
    }

    public function caret():string
    {
        return $this->caret;
    }

    public function single(string $tag,array $attrs=[]):string
    {
        return $this->indent().'<'.$tag.$this->attrs($attrs).'/>'.$this->caret();
    }

    public function start(string $tag,array $attrs=[]):string
    {
        $this->stack[] = $tag;

        $output=$this->indent().'<'.$tag.$this->attrs($attrs).'>'.$this->caret();

        $this->indent++;

        return $output;
    }

    public function end():string
    {
        if(empty($this->_stack)) {
            throw new Exception('Base\\XML::end(): Stack empty');
        }

        $tag=array_pop($this->_stack);

        $this->indent--;

        return $this->indent().'</'.$tag.'>'.$this->caret();
    }

    public function content(string $content=''):string
    {
        return $this->indent().$content.$this->caret();
    }

    public function element(string $tag,array $attrs=[],$content=null):string
    {
        if($content===false) {
            return $this->single($tag, $attrs);
        }

        if(!isset($content)) {
            return $this->start($tag, $attrs);
        }

        if(is_callable($content)) {
            $content=call_user_func($content, $this);
        }
        else if(!is_string($content)) {
            $content='';
        }

        return $this->start($tag, $attrs).$content.$this->end();
    }

}
