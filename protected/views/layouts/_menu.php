<?php
$_m = isset(Yii::app()->controller->module) ? Yii::app()->controller->module->id : '';
$_c = Yii::app()->controller->id;
$_a = Yii::app()->controller->action->id;

function _l($name, $icon)
{
    return '<i class="icon-'.$icon.'"></i><span class="menu-text">'.tt($name).'</span><b class="arrow icon-angle-down"></b>';
}

function _l2($name)
{
    return '<i class="icon-double-angle-right"></i>'.tt($name);
}

function _u($url)
{
    return Yii::app()->createUrl($url);
}

function _ch($controller, $action)
{
    return SH::checkServiceFor(MENU_ELEMENT_VISIBLE, $controller, $action);
}

function _i($name)
{
    return array('class'=> Yii::app()->controller->id==$name ? 'active open' : '');
}

$_l = array(
    'class' => 'dropdown-toggle',
);

$isStd   = Yii::app()->user->isStd;
$isTch   = Yii::app()->user->isTch;
$isAdmin = Yii::app()->user->isAdmin;


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
            'label' => _l('Админ. панель', 'dashboard'),
            'url' => '#',
            'linkOptions'=>$_l,
            'itemOptions'=>array('class'=> $_m=='admin' ? 'active open' : ''),
            'items' => array(
                array(
                    'label'  => _l2('Преподаватели'),
                    'url'    => _u('/admin/default/teachers'),
                    'active' => $_a=='teachers' || $_a=='grants'
                ),
                array(
                    'label'  => _l2('Студенты'),
                    'url'    => _u('/admin/default/students'),
                    'active' => $_a=='students'
                ),
                array(
                    'label'  => _l2('Эл. журнал'),
                    'url'    => _u('/admin/default/journal'),
                    'active' => $_a=='journal' && $_m=='admin'
                ),
                array(
                    'label'  => _l2('Ведение модулей'),
                    'url'    => _u('/admin/default/modules'),
                    'active' => $_a=='modules' && $_m=='admin'
                ),
                array(
                    'label'  => _l2('Абитуриент'),
                    'url'    => _u('/admin/default/entrance'),
                    'active' => $_a=='entrance' && $_m=='admin'
                ),
                array(
                    'label'  => _l2('Меню'),
                    'url'    => _u('/admin/default/menu'),
                    'active' => $_a=='menu' && $_m=='admin'
                ),
            ),
            'visible' => $isAdmin,
        ),
        array(
            'label' => _l('Расписание', 'calendar'),
            'url' => '#',
            'linkOptions'=> $_l,
            'itemOptions'=>_i('timeTable'),
            'items' => array(
                array(
                    'label'   => _l2('Академ. группы'),
                    'url'     => _u('/timeTable/group'),
                    'active'  => $_c=='timeTable' && $_a=='group',
                    'visible' => _ch('timeTable', 'group')
                ),
                array(
                    'label'   => _l2('Преподавателя'),
                    'url'     => _u('/timeTable/teacher'),
                    'active'  => $_c=='timeTable' && $_a=='teacher',
                    'visible' => _ch('timeTable', 'teacher')
                ),
                array(
                    'label'   => _l2('Студента'),
                    'url'     => _u('/timeTable/student'),
                    'active'  => $_c=='timeTable' && $_a=='student',
                    'visible' => _ch('timeTable', 'student')
                ),
                array(
                    'label'   => _l2('Аудитории'),
                    'url'     => _u('/timeTable/classroom'),
                    'active'  => $_c=='timeTable' && $_a=='classroom',
                    'visible' => _ch('timeTable', 'classroom')
                ),
                array(
                    'label'   => _l2('Свободные аудитории'),
                    'url'     => _u('/timeTable/freeClassroom'),
                    'active'  => $_c=='timeTable' && $_a=='freeClassroom',
                    'visible' => _ch('timeTable', 'freeClassroom')
                ),
            ),
            'visible' => _ch('timeTable', 'main')
        ),
        array(
            'label' => _l('Рабочий план', 'edit'),
            'url' => '#',
            'linkOptions'=> $_l,
            'itemOptions'=>_i('workPlan'),
            'items' => array(
                array(
                    'label'   => _l2('Специальности'),
                    'url'     => _u('/workPlan/speciality'),
                    'active'  => $_c=='workPlan' && $_a=='speciality',
                    'visible' => _ch('workPlan', 'speciality')
                ),
                array(
                    'label'   => _l2('Группы'),
                    'url'     => _u('/workPlan/group'),
                    'active'  => $_c=='workPlan' && $_a=='group',
                    'visible' => _ch('workPlan', 'group')
                ),
                array(
                    'label'   => _l2('Студента'),
                    'url'     => _u('/workPlan/student'),
                    'active'  => $_c=='workPlan' && $_a=='student',
                    'visible' => _ch('workPlan', 'student')
                ),
            ),
            'visible' => _ch('workPlan', 'main')
        ),
        array(
            'label' => _l('Успеваемость', 'list'),
            'url' => '#',
            'linkOptions'=> $_l,
            'itemOptions'=>_i('progress'),
            'items' => array(
                array(
                    'label'   => _l2('Эл. журнал'),
                    'url'     => _u('/progress/journal'),
                    'visible' => _ch('progress', 'journal') && $isTch,
                    'active'  => $_c=='progress' && $_a=='journal'
                ),
                array(
                    'label'   => _l2('Ведение модулей'),
                    'url'     => _u('/progress/modules'),
                    'visible' => _ch('progress', 'modules') && $isTch,
                    'active'  => $_c=='progress' && $_a=='modules'
                ),
                array(
                    'label'   => _l2('Тематический план'),
                    'url'     => _u('/progress/thematicPlan'),
                    'visible' => _ch('progress', 'thematicPlan') && $isTch,
                    'active'  => $_c=='progress' && $_a=='thematicPlan'
                ),
            ),
            'visible' => _ch('progress', 'main')
        ),
        array(
            'label' => _l('Док.-оборот', 'folder-open'),
            'url' => '#',
            'linkOptions'=> $_l,
            'itemOptions'=>_i('docs'),
            'items' => array(
                array(
                    'label'   => _l2('Документооборот'),
                    'url'     => _u('/docs/tddo'),
                    'visible' => _ch('docs', 'tddo') && $isTch,
                    'active'  => $_c=='docs' && stristr($_a, 'tddo')
                ),
            ),
            'visible' => _ch('docs', 'main') && $isTch,
        ),
        array(
            'label' => _l('Абитуриент', 'book'),
            'url' => '#',
            'linkOptions'=> $_l,
            'itemOptions'=>_i('entrance'),
            'items' => array(
                array(
                    'label'   => _l2('Ход приема документов'),
                    'url'     => _u('/entrance/documentReception'),
                    'visible' => _ch('entrance', 'documentReception'),
                    'active'  => $_c=='entrance' && $_a=='documentReception'
                ),
                array(
                    'label'   => _l2('Рейтинговый список'),
                    'url'     => _u('/entrance/rating'),
                    'visible' => _ch('entrance', 'rating'),
                    'active'  => $_c=='entrance' && $_a=='rating' && !Yii::app()->request->getParam('sortByStatus', null)
                ),
                array(
                    'label'   => _l2('Список рекомендованных'),
                    'url'     => _u('/entrance/rating', array('sortByStatus' => 1)),
                    'visible' => _ch('entrance', 'rating'),
                    'active'  => $_c=='entrance' && $_a=='rating' && Yii::app()->request->getParam('sortByStatus', null)
                ),
                array(
                    'label'   => _l2('Регистрация'),
                    'url'     => _u('/entrance/registration'),
                    'visible' => _ch('entrance', 'registration'),
                    'active'  => $_c=='entrance' && $_a=='registration'
                ),
            ),
            'visible' => _ch('entrance', 'main')
        ),
        array(
            'label' => _l('Нагрузка', 'briefcase'),
            'url' => '#',
            'linkOptions'=> $_l,
            'itemOptions'=>_i('workLoad'),
            'items' => array(
                array(
                    'label'   => _l2('Личная'),
                    'url'     => _u('/workLoad/self'),
                    'visible' => _ch('workLoad', 'self') && $isTch,
                    'active'  => $_c=='workLoad' && $_a=='self'
                ),
                array(
                    'label'   => _l2('Преподавателя'),
                    'url'     => _u('/workLoad/teacher'),
                    'visible' => _ch('workLoad', 'teacher'),
                    'active'  => $_c=='workLoad' && $_a=='teacher'
                ),
                array(
                    'label'   => _l2('Объем учебной нагрузки'),
                    'url'     => _u('/workLoad/amount'),
                    'visible' => _ch('workLoad', 'amount'),
                    'active'  => $_c=='workLoad' && $_a=='amount'
                ),
            ),
            'visible' => _ch('workLoad', 'main')
        ),
        array(
            'label' => _l('Оплата', 'money'),
            'url' => '#',
            'linkOptions'=> $_l,
            'itemOptions'=>_i('payment'),
            'items' => array(
                array(
                    'label'   => _l2('Общежитие'),
                    'url'     => _u('/payment/hostel'),
                    'visible' => _ch('payment', 'hostel'),
                    'active'  => $_c=='payment' && $_a=='hostel'
                ),
                array(
                    'label'   => _l2('Обучение'),
                    'url'     => _u('/payment/education'),
                    'visible' => _ch('payment', 'education'),
                    'active'  => $_c=='payment' && $_a=='education',
                ),
            ),
            'visible' => _ch('payment', 'main') && $isStd
        ),
        array(
            'label' => _l('Другое', 'globe'),
            'url' => '#',
            'linkOptions'=> $_l,
            'itemOptions'=>_i('other'),
            'items' => array(
                array(
                    'label'   => _l2('Телефонный справочник'),
                    'url'     => _u('/other/phones'),
                    'visible' => _ch('other', 'phones'),
                    'active'  => $_c=='other' && $_a=='phones'
                ),
                array(
                    'label'   => _l2('Запись на гос. экзамены'),
                    'url'     => _u('/other/gostem'),
                    'active'  => $_c=='other' && $_a=='gostem',
                    'visible' => _ch('other', 'gostem') && $isStd,
                ),
            ),
            'visible' => _ch('other', 'main')
        ),
    ),
));

