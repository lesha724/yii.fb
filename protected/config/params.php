<?php
/**
 * Created by PhpStorm.
 * User: Neff
 * Date: 30.09.14
 * Time: 9:14
 */
$file = dirname(__FILE__).'/params.inc';
$arr=array();
if(file_exists($file))
{
    $content = file_get_contents($file);
    if(!empty($content))
        $arr = unserialize(base64_decode($content));
}

return $arr;
?>