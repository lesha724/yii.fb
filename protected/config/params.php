<?php
/**
 * Created by PhpStorm.
 * User: Neff
 * Date: 30.09.14
 * Time: 9:14
 */
$file = dirname(__FILE__).'/params.inc';
$content = file_get_contents($file);
$arr = unserialize(base64_decode($content));

return $arr;
?>