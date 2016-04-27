<?php
$file = dirname(__FILE__).'/mail.inc';
$arr=array();
if(file_exists($file))
{
    $content = file_get_contents($file);
    if(!empty($content))
        $arr = unserialize(base64_decode($content));
}else{
    $file_ = fopen($file, 'w');
    fclose($file_);
}
return $arr;
?>