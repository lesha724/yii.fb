<?php
/**
 * Created by PhpStorm.
 * User: neffa
 * Date: 24.10.2018
 * Time: 16:01
 */

$ps137 = PortalSettings::model()->getSettingFor(PortalSettings::ENABLE_REGISTRATION_PASS);

if($ps137!=0):
    //$passList = $student->getPass();
else:
    echo CHtml::tag('div', array('class'=> 'alert alert-error'), tt('Регистрация пропусков не активна'));
endif;