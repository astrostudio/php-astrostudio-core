<?php
namespace Base;

class CSS
{
    static public function parseClass(array|string $class):array
    {
        if(is_array($class)) {
            return(array_unique($class));
        }

        $classes=[];
        $items=explode(' ', $class);

        foreach($items as $item){
            if(empty(trim($item))) {
                continue;
            }

            $classes[]=$item;
        }

        return array_unique($classes);
    }

    static public function printClass(array|string $classes):string
    {
        $classes=is_array($classes)?$classes:self::parseClass(strval($classes));
        $classes=array_unique($classes);
        $output='';
        $d='';

        foreach($classes as $class){
            $output.=$d;
            $output.=$class;
            $d=' ';
        }

        return $output;
    }

    static public function mergeClass():array
    {
        $classes=[];
        $args=func_get_args();

        foreach($args as $arg){
            $cc=self::parseClass($arg);

            foreach($cc as $class){
                $classes[]=$class;
            }
        }

        return array_unique($classes);
    }

    static public function parseStyle(array|string $style):array
    {
        if(is_array($style)) {
            return $style;
        }

        $styles=[];
        $style=strval($style);
        $items=explode(';', $style);

        foreach($items as $item){
            $pair=explode(':', $item);

            if(count($pair)!=2) {
                continue;
            }

            $pair[0]=trim($pair[0]);
            $pair[1]=trim($pair[1]);

            if((strlen($pair[0])==0) or (strlen($pair[1])==0)) {
                continue;
            }

            $styles[$pair[0]]=$pair[1];
        }

        return $styles;
    }

    static public function printStyle(array|string $style):string
    {
        if(!is_array($style)) {
            return $style;
        }

        $output='';

        foreach($style as $name=>$value){
            $output.=$name.':'.$value.';';
        }

        return $output;
    }

    static public function mergeStyle():array
    {
        $styles=[];
        $args=func_get_args();

        foreach($args as $arg){
            $style=self::parseStyle($arg);

            foreach($style as $name=>$value){
                $styles[$name]=$value;
            }
        }

        return $styles;
    }

    static public function mergeAttrs():array
    {
        $attrs=[];
        $args=func_get_args();

        foreach($args as $arg){
            if(!is_array($arg)) {
                continue;
            }

            foreach($arg as $name=>$value){
                if($name=='class') {
                    $attrs[$name]=self::printClass(self::mergeClass($attrs[$name]??[], $value));

                    continue;
                }

                if($name=='style') {
                    $attrs[$name]=self::printStyle(self::mergeStyle($attrs[$name]??[], $value));

                    continue;
                }

                $attrs[$name]=$value;
            }
        }

        return $attrs;
    }

    static public function mergeClassAttrs():array
    {
        $attrs=[];
        $args=func_get_args();

        foreach($args as $arg){
            if(!is_array($arg)) {
                continue;
            }

            foreach($arg as $name=>$value){
                if($name=='class') {
                    $attrs[$name]=self::printClass(self::mergeClass($attrs[$name]??[], $value));

                    continue;
                }

                $attrs[$name]=$value;
            }
        }

        return $attrs;
    }

    static public function mergeStyleAttrs():array
    {
        $attrs=[];
        $args=func_get_args();

        foreach($args as $arg){
            if(!is_array($arg)) {
                continue;
            }

            foreach($arg as $name=>$value){
                if($name=='style') {
                    $attrs[$name]=self::printStyle(self::mergeStyle($attrs[$name]??[], $value));

                    continue;
                }

                $attrs[$name]=$value;
            }
        }

        return $attrs;
    }

    static public function classes()
    {
        $args=func_get_args();
        $output='';
        $d='';

        foreach($args as $arg){
            if(!empty(trim($arg))) {
                $output.=$d;
                $output.=$arg;
                $d=' ';
            }
        }

        return $output;
    }

    static public function style(array|string $style):string
    {
        if(is_string($style)) {
            return $style;
        }

        $sstyle='';

        foreach($style as $name=>$value){
            $sstyle.=$name.':'.$value.';';
        }

        return $sstyle;
    }

    static public function parse(array|string $style):array
    {
        if(is_array($style)) {
            return $style;
        }

        $options= [];
        $items=explode(';', $style);

        foreach($items as $item){
            $attrs=explode(':', $item);

            if(count($attrs)>=2) {
                $options[$attrs[0]]=$attrs[1];
            }
        }

        return $options;
    }

    static public function merge(array|string $style1,array|string $style2):string
    {
        return self::style(array_merge(self::parse($style1), self::parse($style2)));
    }

}
