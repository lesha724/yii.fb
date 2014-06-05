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
                array(
                    'label' => '<i class="icon-double-angle-right"></i>'.tt('Эл. журнал'),
                    'url' => Yii::app()->createUrl('/admin/default/journal'),
                    'active' => $action=='journal' && $module=='admin'
                ),
                array(
                    'label' => '<i class="icon-double-angle-right"></i>'.tt('Ведение модулей'),
                    'url' => Yii::app()->createUrl('/admin/default/modules'),
                    'active' => $action=='modules' && $module=='admin'
                ),
            ),
            'visible' => Yii::app()->user->isAdmin,
        ),
        array(
            'label' => '<i class="icon-calendar"></i><span class="menu-text">'.tt('Расписание').'</span><b class="arrow icon-angle-down"></b>',
            'url' => '#',
            'linkOptions'=> array(
                'class' => 'dropdown-toggle',
            ),
            'itemOptions'=>array('class'=> $controller=='timeTable' ? 'active open' : ''),
            'items' => array(
                array(
                    'label' => '<i class="icon-double-angle-right"></i>'.tt('Академ. группы'),
                    'url' => Yii::app()->createUrl('/timeTable/group'),
                    'active' => $controller=='timeTable' && $action=='group'
                ),
                array(
                    'label' => '<i class="icon-double-angle-right"></i>'.tt('Преподавателя'),
                    'url' => Yii::app()->createUrl('/timeTable/teacher'),
                    'active' => $controller=='timeTable' && $action=='teacher'
                ),
                array(
                    'label' => '<i class="icon-double-angle-right"></i>'.tt('Студента'),
                    'url' => Yii::app()->createUrl('/timeTable/student'),
                    'active' => $controller=='timeTable' && $action=='student'
                ),
                array(
                    'label' => '<i class="icon-double-angle-right"></i>'.tt('Аудитории'),
                    'url' => Yii::app()->createUrl('/timeTable/classroom'),
                    'active' => $controller=='timeTable' && $action=='classroom'
                ),
                array(
                    'label' => '<i class="icon-double-angle-right"></i>'.tt('Свободные аудитории'),
                    'url' => Yii::app()->createUrl('/timeTable/freeClassroom'),
                    'active' => $controller=='timeTable' && $action=='freeClassroom'
                ),
            ),
        ),
        /*array(
            'label' => '<i class="icon-edit"></i><span class="menu-text">'.tt('Рабочий план').'</span><b class="arrow icon-angle-down"></b>',
            'url' => '#',
            'linkOptions'=> array(
                'class' => 'dropdown-toggle',
            ),
            'itemOptions'=>array('class'=> $controller=='workPlan' ? 'active open' : ''),
            'items' => array(
                array(
                    'label' => '<i class="icon-double-angle-right"></i>'.tt('Студента'),
                    'url' => Yii::app()->createUrl('/workPlan/student'),
                    'active' => $controller=='workPlan' && $action=='student'
                ),
            ),
        ),*/
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
                    'active' => $controller=='progress' && $action=='journal'
                ),
                array(
                    'label' => '<i class="icon-double-angle-right"></i>'.tt('Ведение модулей'),
                    'url' => Yii::app()->createUrl('/progress/modules'),
                    'visible' => Yii::app()->user->isTch,
                    'active' => $controller=='progress' && $action=='modules'
                ),
                array(
                    'label' => '<i class="icon-double-angle-right"></i>'.tt('Тематический план'),
                    'url' => Yii::app()->createUrl('/progress/thematicPlan'),
                    'visible' => Yii::app()->user->isTch,
                    'active' => $controller=='progress' && $action=='thematicPlan'
                ),
            ),
        ),
        array(
            'label' => '<i class="icon-folder-open"></i><span class="menu-text">'.tt('Док.-оборот').'</span><b class="arrow icon-angle-down"></b>',
            'url' => '#',
            'linkOptions'=> array(
                'class' => 'dropdown-toggle',
            ),
            'itemOptions'=>array('class'=> $controller=='docs' ? 'active open' : ''),
            'items' => array(
                array(
                    'label' => '<i class="icon-double-angle-right"></i>'.tt('Документооборот'),
                    'url' => Yii::app()->createUrl('/docs/tddo'),
                    'visible' => Yii::app()->user->isTch || Yii::app()->user->isAdmin,
                    'active' => $controller=='docs' && stristr($action, 'tddo')
                ),
            ),
        ),
        array(
            'label' => '<i class="icon-globe"></i><span class="menu-text">'.tt('Другое').'</span><b class="arrow icon-angle-down"></b>',
            'url' => '#',
            'linkOptions'=> array(
                'class' => 'dropdown-toggle',
            ),
            'itemOptions'=>array('class'=> $controller=='other' ? 'active open' : ''),
            'items' => array(
                array(
                    'label' => '<i class="icon-double-angle-right"></i>'.tt('Телефонный справочник'),
                    'url' => Yii::app()->createUrl('/other/phones'),
                    'active' => $controller=='other' && $action=='phones'
                ),
                array(
                    'label' => '<i class="icon-double-angle-right"></i>'.tt('Запись на гос. экзамены'),
                    'url' => Yii::app()->createUrl('/other/gostem'),
                    'active' => $controller=='other' && $action=='gostem',
                    'visible' => Yii::app()->user->isStd,
                ),
            ),
        ),
    ),
));

