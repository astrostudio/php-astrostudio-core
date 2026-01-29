<?php
namespace Base;

class SVG extends XML
{

    const PRECISION=2;

    static public function stroke(string $color=null,int $width=null):string
    {
        $style=[];

        if(isset($color)) {
            $style['stroke']=$color;
        }

        if(isset($width)) {
            $style['stroke-width']=$width;
        }

        return CSS::printStyle($style);
    }

    static public function round(float $value=0.0,int $precision=self::PRECISION):string
    {
        return strval(round($value, $precision));
    }

    static public function viewbox(int $left=0,int $stop=0,int $width=0,int $height=0):string
    {
        return $left.' '.$stop.' '.$width.' '.$height;
    }

    static public function rgb(int $r,int $g,int $b)
    {
        return 'rgb('.$r.','.$g.','.$b.')';
    }

    static public function card(int $x,int $y,int $radius,float $angle=0.0):array
    {
        $r=deg2rad($angle);

        return [
            'x'=>$x+round($radius*cos($r)),
            'y'=>$y-round($radius*sin($r))
        ];
    }

    static public function pointList(array $points=[]):string
    {
        $s='';
        $d='';
        $i=0;

        foreach($points as $point){
            $s.=$d;
            $s.=$point;
            $d=($i%2==0)?' ':',';
            ++$i;
        }

        return $s;
    }

    static public function points(array $points=[]):string
    {
        $s='';
        $d='';

        foreach($points as $point){
            $s.=$d;
            $s.=$point['x'].' '.$point['y'];
            $d=',';
        }

        return $s;
    }

    protected array $layers=[];

    public function __construct(int $indent=0,string $spaces='    ',string $caret="\n")
    {
        parent::__construct($indent, $spaces, $caret);
    }

    public function append(string $name,string $body='')
    {
        if(!isset($this->layers[$name])) {
            $this->layers[$name]='';
        }

        $this->layers[$name].=$body;
    }

    public function remove(string $name)
    {
        unset($this->layers[$name]);
    }

    public function assign(string $name,string $body='')
    {
        $this->layers[$name]=$body;
    }

    public function fetch(string $name):string
    {
        return $this->layers[$name]??'';
    }

    public function begin(int $width,int $height,array $attrs=[]):string
    {
        $attrs['xmlns']=$attrs['xmlns']??'http://www.w3.org/2000/svg';
        $attrs['version']=$attrs['version']??'1.1';
        $attrs['width']=$width;
        $attrs['height']=$height;

        return $this->start('svg', $attrs);
    }

    public function view(int $width,int $height,float $ratio=null,int $left=0,int $stop=0,int $swidth=null,int $sheight=null,array $attrs=[]):string
    {
        $attrs['preserveAspectRatio']=self::round($ratio??1.0);
        $attrs['viewbox']=self::viewbox($left, $stop, $swidth??$width, $sheight??$height);

        return $this->begin($width, $height, $attrs);
    }

    public function group(array $attrs=[],$content=null):string
    {
        return $this->element('g', $attrs, $content);
    }

    public function translate(int $x=0,int $y=0,array $attrs=[],$content=null):string
    {
        $attrs['transform']='translate('.$x.','.$y.')';

        return $this->group($attrs, $content);
    }

    public function scale(float $s=1.0,array $attrs=[],$content=null):string
    {
        $attrs['transform']='scale('.self::round($s).')';

        return $this->group($attrs, $content);
    }

    public function rotate(int $cx,int $cy,float $delta=0.0,array $attrs= [],$content=null):string
    {
        $attrs['transform']='rotate('.self::round($delta).','.$cx.','.$cy.')';

        return $this->group($attrs, $content);
    }

    public function opacity(float $opacity=1.0,array $attrs=[],$content=null):string
    {
        $attrs['style']=CSS::printStyle(['opacity'=>self::round($opacity)]);

        return $this->group($attrs, $content);
    }

    public function link(string $url='',array $attrs=[],$content=null):string
    {
        $attrs['xlink:href']=$url;

        return $this->element('a', $attrs, $content);
    }

    public function rectangle(int $x,int $y,int $width,int $height,array $attrs=[]):string
    {
        $attrs['x']=$x;
        $attrs['y']=$y;
        $attrs['width']=$width;
        $attrs['height']=$height;

        return $this->single('rect', $attrs);
    }

    public function circle(int $x,int $y,int $radius,array $attrs=[]):string
    {
        $attrs['cx']=$x;
        $attrs['cy']=$y;
        $attrs['r']=$radius;

        return $this->single('circle', $attrs);
    }

    public function line(int $x1,int $y1,int $x2,int $y2,array $attrs=[]):string
    {
        $attrs['x1']=$x1;
        $attrs['y1']=$y1;
        $attrs['x2']=$x2;
        $attrs['y2']=$y2;

        return $this->single('line', $attrs);
    }

    public function radius(int $x,int $y,int $radius,float $angle=0.0,array $attrs=[]):string
    {
        $p=self::card($x, $y, $radius, $angle);

        return $this->line($x, $y, $p['x'], $p['y'], $attrs);
    }

    public function ellipse(int $x,int $y,int $rx,int $ry,array $attrs=[]):string
    {
        $attrs['cx']=$x;
        $attrs['cy']=$y;
        $attrs['rx']=$rx;
        $attrs['ry']=$ry;

        return $this->single('ellipse', $attrs);
    }

    public function polygon(array $points=[],array $attrs=[]):string
    {
        $attrs['points']=self::points($points);

        return $this->single('polygon', $attrs);
    }

    public function polygonList(array $points=[],array $attrs=[]):string
    {
        $attrs['points']=self::pointList($points);

        return $this->single('polygon', $attrs);
    }

    public function polyline(array $points,array $attrs=[]):string
    {
        $attrs['points']=self::points($points);

        return $this->single('polyline', $attrs);
    }

    public function text(int $x,int $y,string $text,array $attrs=[]):string
    {
        $attrs['x']=$x;
        $attrs['y']=$y;

        return $this->element('text', $attrs, $text);
    }

    public function tspan(string $text,array $attrs=[]):string
    {
        return $this->element('tspan', $attrs, $text);
    }

    public function label(int $x,int $y,string $text,array $attrs=[]):string
    {
        return $this->text(
            $x, $y, $text, CSS::mergeStyleAttrs(
                $attrs, ['style'=>[
                'text-anchor'=>'middle',
                'dominant-baseline'=>'central'
                ]]
            )
        );
    }

    public function image(int $x,int $y,int $width,int $height,array $attrs=[]):string
    {
        $attrs['x']=$x;
        $attrs['y']=$y;
        $attrs['width']=$width;
        $attrs['height']=$height;

        return $this->single('image', $attrs);
    }

    public function arc(int $x,int $y,int $r,float $start,float $stop,array $attrs=[]):string
    {
        $s=self::card($x, $y, $r, $start);
        $e=self::card($x, $y, $r, $stop);

        if(abs($stop-$start)>=180.0) {
            $v=1;
        }
        else {
            $v=0;
        }

        $v=0;

        $d='M'.$s['x'].','.$s['y'].' A'.$r.','.$r.' 0 '.$v.',0 '.$e['x'].','.$e['y'].'';

        $attrs['d']=$d;

        return $this->single('path', $attrs);
    }

    public function sector(int $x,int $y,int $r1,int $r2,float $start,float $stop,array $attrs=[]):string
    {
        if($r1<$r2) {
            $r=$r1;
            $r1=$r2;
            $r2=$r;
        }

        $s1=self::card($x, $y, $r1, $start);
        $e1=self::card($x, $y, $r1, $stop);
        $s2=self::card($x, $y, $r2, $start);
        $e2=self::card($x, $y, $r2, $stop);

        if(abs($stop-$start)>=180.0) {
            $v=1;
        }
        else {
            $v=0;
        }
        $v=0;

        $d='M'.$s2['x'].','.$s2['y'].' L'.$s1['x'].','.$s1['y'].' A'.$r1.','.$r1.' 0 '.$v.',0 '.$e1['x'].','.$e1['y'].' L'.$e2['x'].','.$e2['y'].' A'.$r2.','.$r2.' 0 '.$v.',1 '.$s2['x'].','.$s2['y'].' z';

        $attrs['d']=$d;

        return $this->single('path', $attrs);
    }
}
