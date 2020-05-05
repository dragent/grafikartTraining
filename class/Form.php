<?php
class Form
{
    public static $class="form-control";
    public static function checkbox($name,$value=null,$price=null,$data=[])
    {
        $check="";
        if((isset($data["$name"])) &&(in_array($value,$data["$name"])))
        {
            $check.="checked";
        }
        $check.='checked.class="'.self::class.'"';
        return <<<HTML
                <input type="checkbox" name="{$name}[]" value="$value"  $check>$value - $price €  </input>
HTML;
    }
    public static function radio($name,$value=null,$price=null,$data=[])
    {
        $check="";
        if((isset($data["$name"])) &&(in_array($value,$data["$name"])))
        {
            $check.="checked";
        }
        $check.='checked.class="'.self::class.'"';
        return <<<HTML
                <input type="radio" name="{$name}[]" value="$value"  $check>$value - $price €  </input>
HTML;
    }

    public static function select(string $name, $value, array $options)
    {
        $html_options=[];
        foreach ($options as $k=>$option)
        {
            $attributes=$k==$value?'selected':'';
            $html_options[]="<option value='$k' $attributes>$option</option>";
        }
        return "<select class='form-control' name='$name'>".implode($html_options)."</select>";
    }
}