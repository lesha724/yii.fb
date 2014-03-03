<?php

$controller = Yii::app()->controller->id;
$action     = Yii::app()->controller->action->id;

$this->widget('zii.widgets.CMenu', array(
    'encodeLabel' => false,
    'htmlOptions' => array(
        'id' => false,
        'class' => 'nav nav-list'
    ),
    'submenuHtmlOptions' => array(
        'class' => 'submenu',
    ),

    'items'=>array(
        array(
            'label' => '<i class="icon-list"></i><span class="menu-text">'.tt('Успеваемость').'</span><b class="arrow icon-angle-down"></b>',
            'url' => '#',
            'linkOptions'=> array(
                'class' => 'dropdown-toggle',
            ),
            'itemOptions'=>array('class'=> $controller=='progress' ? 'active open' : ''),
            'items' => array(
                array(
                    'label' => '<i class="icon-double-angle-right"></i>'.tt('Эл. журнал'),
                    'url' => Yii::app()->createUrl('/progress/journal'),
                    'visible' => Yii::app()->user->isTch,
                    'active' => $action=='journal'
                ),
            ),

        ),
    ),
));

