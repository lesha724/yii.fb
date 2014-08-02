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
                array(
                    'label' => '<i class="icon-double-angle-right"></i>'.tt('Абитуриент'),
                    'url' => Yii::app()->createUrl('/admin/default/entrance'),
                    'active' => $action=='entrance' && $module=='admin'
                ),
                array(
                    'label' => '<i class="icon-double-angle-right"></i>'.tt('Меню'),
                    'url' => Yii::app()->createUrl('/admin/default/menu'),
                    'active' => $action=='menu' && $module=='admin'
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
                    'active' => $controller=='timeTable' && $action=='group',
                    'visible' => SH::checkServiceFor(MENU_ELEMENT_VISIBLE,'timeTable', 'group')
                ),
                array(
                    'label' => '<i class="icon-double-angle-right"></i>'.tt('Преподавателя'),
                    'url' => Yii::app()->createUrl('/timeTable/teacher'),
                    'active' => $controller=='timeTable' && $action=='teacher',
                    'visible' => SH::checkServiceFor(MENU_ELEMENT_VISIBLE,'timeTable', 'teacher')
                ),
                array(
                    'label' => '<i class="icon-double-angle-right"></i>'.tt('Студента'),
                    'url' => Yii::app()->createUrl('/timeTable/student'),
                    'active' => $controller=='timeTable' && $action=='student',
                    'visible' => SH::checkServiceFor(MENU_ELEMENT_VISIBLE, 'timeTable', 'student')
                ),
                array(
                    'label' => '<i class="icon-double-angle-right"></i>'.tt('Аудитории'),
                    'url' => Yii::app()->createUrl('/timeTable/classroom'),
                    'active' => $controller=='timeTable' && $action=='classroom',
                    'visible' => SH::checkServiceFor(MENU_ELEMENT_VISIBLE, 'timeTable', 'classroom')
                ),
                array(
                    'label' => '<i class="icon-double-angle-right"></i>'.tt('Свободные аудитории'),
                    'url' => Yii::app()->createUrl('/timeTable/freeClassroom'),
                    'active' => $controller=='timeTable' && $action=='freeClassroom',
                    'visible' => SH::checkServiceFor(MENU_ELEMENT_VISIBLE, 'timeTable', 'freeClassroom')
                ),
            ),
            'visible' => SH::checkServiceFor(MENU_ELEMENT_VISIBLE,'timeTable', 'main')
        ),
        array(
            'label' => '<i class="icon-edit"></i><span class="menu-text">'.tt('Рабочий план').'</span><b class="arrow icon-angle-down"></b>',
            'url' => '#',
            'linkOptions'=> array(
                'class' => 'dropdown-toggle',
            ),
            'itemOptions'=>array('class'=> $controller=='workPlan' ? 'active open' : ''),
            'items' => array(
                array(
                    'label' => '<i class="icon-double-angle-right"></i>'.tt('Специальности'),
                    'url' => Yii::app()->createUrl('/workPlan/speciality'),
                    'active' => $controller=='workPlan' && $action=='speciality',
                    'visible' => SH::checkServiceFor(MENU_ELEMENT_VISIBLE, 'workPlan', 'speciality')
                ),
                array(
                    'label' => '<i class="icon-double-angle-right"></i>'.tt('Группы'),
                    'url' => Yii::app()->createUrl('/workPlan/group'),
                    'active' => $controller=='workPlan' && $action=='group',
                    'visible' => SH::checkServiceFor(MENU_ELEMENT_VISIBLE, 'workPlan', 'group')
                ),
                array(
                    'label' => '<i class="icon-double-angle-right"></i>'.tt('Студента'),
                    'url' => Yii::app()->createUrl('/workPlan/student'),
                    'active' => $controller=='workPlan' && $action=='student',
                    'visible' => SH::checkServiceFor(MENU_ELEMENT_VISIBLE, 'workPlan', 'student')
                ),
            ),
            'visible' => SH::checkServiceFor(MENU_ELEMENT_VISIBLE, 'workPlan', 'main')
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
            'visible' => SH::checkServiceFor(MENU_ELEMENT_VISIBLE,'progress', 'main')
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
            'visible' => SH::checkServiceFor(MENU_ELEMENT_VISIBLE,'docs', 'main')
        ),
        array(
            'label' => '<i class="icon-book"></i><span class="menu-text">'.tt('Абитуриент').'</span><b class="arrow icon-angle-down"></b>',
            'url' => '#',
            'linkOptions'=> array(
                'class' => 'dropdown-toggle',
            ),
            'itemOptions'=>array('class'=> $controller=='entrance' ? 'active open' : ''),
            'items' => array(
                array(
                    'label' => '<i class="icon-double-angle-right"></i>'.tt('Ход приема документов'),
                    'url' => Yii::app()->createUrl('/entrance/documentReception'),
                    'visible' => SH::checkServiceFor(MENU_ELEMENT_VISIBLE,'entrance', 'documentReception'),
                    'active' => $controller=='entrance' && $action=='documentReception'
                ),
                array(
                    'label' => '<i class="icon-double-angle-right"></i>'.tt('Рейтинговый список'),
                    'url' => Yii::app()->createUrl('/entrance/rating'),
                    'visible' => SH::checkServiceFor(MENU_ELEMENT_VISIBLE,'entrance', 'rating'),
                    'active' => $controller=='entrance' && $action=='rating'
                ),
                array(
                    'label' => '<i class="icon-double-angle-right"></i>'.tt('Регистрация'),
                    'url' => Yii::app()->createUrl('/entrance/registration'),
                    'visible' => SH::checkServiceFor(MENU_ELEMENT_VISIBLE,'entrance', 'registration'),
                    'active' => $controller=='entrance' && $action=='registration'
                ),
            ),
            'visible' => SH::checkServiceFor(MENU_ELEMENT_VISIBLE,'entrance', 'main')
        ),
        array(
            'label' => '<i class="icon-briefcase"></i><span class="menu-text">'.tt('Нагрузка').'</span><b class="arrow icon-angle-down"></b>',
            'url' => '#',
            'linkOptions'=> array(
                'class' => 'dropdown-toggle',
            ),
            'itemOptions'=>array('class'=> $controller=='workLoad' ? 'active open' : ''),
            'items' => array(
                array(
                    'label' => '<i class="icon-double-angle-right"></i>'.tt('Личная'),
                    'url' => Yii::app()->createUrl('/workLoad/self'),
                    'visible' => SH::checkServiceFor(MENU_ELEMENT_VISIBLE, 'workLoad', 'self') && Yii::app()->user->isTch,
                    'active' => $controller=='workLoad' && $action=='self'
                ),
                array(
                    'label' => '<i class="icon-double-angle-right"></i>'.tt('Преподавателя'),
                    'url' => Yii::app()->createUrl('/workLoad/teacher'),
                    'visible' => SH::checkServiceFor(MENU_ELEMENT_VISIBLE, 'workLoad', 'teacher'),
                    'active' => $controller=='workLoad' && $action=='teacher'
                ),
                array(
                    'label' => '<i class="icon-double-angle-right"></i>'.tt('Объем учебной нагрузки'),
                    'url' => Yii::app()->createUrl('/workLoad/amount'),
                    'visible' => SH::checkServiceFor(MENU_ELEMENT_VISIBLE, 'workLoad', 'amount'),
                    'active' => $controller=='workLoad' && $action=='amount'
                ),
            ),
            'visible' => SH::checkServiceFor(MENU_ELEMENT_VISIBLE, 'workLoad', 'main')
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
            'visible' => SH::checkServiceFor(MENU_ELEMENT_VISIBLE,'other', 'main')
        ),
    ),
));

