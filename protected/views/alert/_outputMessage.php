<?php
/**
 * Created by PhpStorm.
 * User: neffa
 * Date: 19.02.2019
 * Time: 16:43
 */

/**
 * @var $model Users
 * @var $this AlertController
 * @var $message Um
 */


list($url, $name) = $message->getUserToFotoAndName();

echo $this->renderPartial('_message', array(
    'date' => $message->um3,
    'text' => $message->um5,
    'url'=> $url,
    'name' => $name,
    'extra' => '',
    'model' =>$message,
    'extraTitle' => ''
));