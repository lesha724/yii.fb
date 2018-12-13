<?php
/**
 * Created by PhpStorm.
 * User: neffa
 * Date: 24.10.2018
 * Time: 16:01
 */

/**
 * @var $st St
 */

$ps137 = PortalSettings::model()->getSettingFor(PortalSettings::ENABLE_REGISTRATION_PASS);

if($ps137!=0):
    $passList = $st->getPass();

    $tabs = array(
        array(
            'label'=>tt('Пропуски'),
            'content'=>$this->renderPartial(
                'studentCard/_passes',
                array('passList'=>$passList),
                true
            ),
            'active'=>true
        ),
        array(
            'label'=>tt('Справки'),
            'content'=>$this->renderPartial(
                'studentCard/_references',
                array(),
                true
            ),
        )
    );

    $this->widget('bootstrap.widgets.TbTabs', array(
        'type'=>'tabs',
        'placement'=>'top',
        'tabs'=>$tabs,
    ));

else:
    echo CHtml::tag('div', array('class'=> 'alert alert-error'), tt('Регистрация пропусков не активна'));
endif;