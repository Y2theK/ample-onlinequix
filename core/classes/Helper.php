<?php

class Helper{
    public static function redirect($page)
    {
    //    header("Location:$page");
    header("Location:$page");
    }
    public static function filter($str){
        $str = trim($str);  //cut space
        $str = stripslashes($str);   //cut slash
        $str = htmlspecialchars($str);
        return $str;

    }
    public static function filterHtml($str)
    {
        $str = htmlspecialchars($str);
        return $str;
    }
    public static function slug($str)
    {
        $str = strtolower($str);
        $str = str_replace(' ','-',$str);
        $str .= '-'.uniqid();
        return $str;
    }
    public static function blah()
    {
        return "blah";
    }
}
?>