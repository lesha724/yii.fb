<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
$this->pageHeader=tt('Добро пожаловать в').' '.CHtml::encode(Yii::app()->name);

/*$alreadyRegistered = 1 <= Users::model()->countByAttributes(
        array('u5'=>1,'u6'=>129),
        array(
            'condition'=>'u2 != :U2',
            'params'=>array(':U2'=>"")
        ));*/

switch (Yii::app()->language){
        case 'uk': $id=61; break;
        case 'ru': $id=62; break;
        case 'en': $id=63; break;
        default: $id=62; break;
}

echo PortalSettings::model()->findByPk($id)->ps2;
echo $_SERVER['SERVER_NAME'];
?>

