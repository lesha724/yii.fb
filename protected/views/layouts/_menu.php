<?php
$module     = isset(Yii::app()->controller->module) ? Yii::app()->controller->module->id : '';
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
            'label' => '<i class="icon-dashboard"></i><span class="menu-text">'.tt('Админ. панель').'</span><b class="arrow icon-angle-down"></b>',
            'url' => '#',
            'linkOptions'=> array(
                'class' => 'dropdown-toggle',
            ),
            'itemOptions'=>array('class'=> $module=='admin' ? 'active open' : ''),
            'items' => array(
                array(
                    'label' => '<i class="icon-double-angle-right"></i>'.tt('Преподаватели'),
                    'url' => Yii::app()->createUrl('/admin/default/teachers'),
                    'active' => $action=='teachers' || $action=='grants'
                ),
                array(
                    'label' => '<i class="icon-double-angle-right"></i>'.tt('Студенты'),
                    'url' => Yii::app()->createUrl('/admin/default/students'),
                    'active' => $action=='students'
                ),
            ),
            'visible' => Yii::app()->user->isAdmin,
        ),
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

