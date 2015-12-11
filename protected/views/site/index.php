<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
$this->pageHeader=tt('Добро пожаловать в').' '.CHtml::encode(Yii::app()->name);

$alreadyRegistered = 1 <= Users::model()->countByAttributes(
        array('u5'=>1,'u6'=>129),
        array(
            'condition'=>'u2 != :U2',
            'params'=>array(':U2'=>"")
        ));
?>

