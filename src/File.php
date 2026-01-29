<?php
namespace AstroStudio\Core;

class File
{
    static public function path(array $items=[]):string
    {
        $path='';
        $d='';

        foreach($items as $item){
            $path.=$d;
            $path.=$item;
            $d=DIRECTORY_SEPARATOR;
        }

        return $path;
    }
}
