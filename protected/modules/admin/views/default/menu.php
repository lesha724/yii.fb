<?php
/**
 *
 * @var DefaultController $this
 */

    $this->pageHeader=tt('Отображение пунктов меню');
    $this->breadcrumbs=array(
        tt('Админ. панель'),
    );

    Yii::app()->clientScript->registerPackage('nestable');
    Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/admin/menu.js');

?>

<button type="button" class="btn btn-info btn-small save-form">
    <i class="icon-ok bigger-110"></i>
    <?=tt('Сохранить')?>
</button>

<form id="menu" method="post">
    <?php
        $this->renderPartial('menu/_block', array(
            'settings' => $settings,
            'blocks' => array(
                array(
                    'name'       => 'Абитуриент',
                    'controller' => 'entrance',
                    'items' => array(
                        'documentReception' => 'Ход приема документов',
                        'rating'            => 'Рейтинговый список',
                        'registration'      => 'Регистрация',
                    ),
                ),
                array(
                    'name'       => 'Расписание',
                    'controller' => 'timeTable',
                    'items' => array(
                        'group'         => 'Академ. группы',
                        'teacher'       => 'Преподавателя',
                        'student'       => 'Студента',
                        'classroom'     => 'Аудитории',
                        'freeClassroom' => 'Свободные аудитории',
                    ),
                ),
                array(
                    'name'       => 'Рабочий план',
                    'controller' => 'workPlan',
                    'items' => array(
                        'speciality' => 'Специальности',
                        'group'      => 'Группы',
                        'student'    => 'Студента',
                    ),
                ),
                array(
                    'name'       => 'Успеваемость',
                    'controller' => 'progress',
                    'items' => array(
                        'journal'      => 'Эл. журнал',
                        'modules'      => 'Ведение модулей',
                        'thematicPlan' => 'Тематический план',
                    ),
                ),
				array(
                    'name'       => 'Список',
                    'controller' => 'list',
                    'items' => array(
                        'group'      => 'Группы',
                    ),
                ),
                array(
                    'name'       => 'Док.-оборот',
                    'controller' => 'docs',
                    'items' => array(
                        'tddo' => 'Документооборот',
                    ),
                ),
                array(
                    'name'       => 'Нагрузка',
                    'controller' => 'workLoad',
                    'items' => array(
                        'self'    => 'Личная',
                        'teacher' => 'Преподавателя',
                        'amount'  => 'Объем учебной нагрузки',
                    ),
                ),
                array(
                    'name'       => 'Оплата',
                    'controller' => 'payment',
                    'items' => array(
                        'hostel'    => 'Общежитие',
                        'education' => 'Обучение',
                    ),
                ),
                array(
                    'name'       => 'Другое',
                    'controller' => 'other',
                    'items' => array(
                        'phones' => 'Телефонный справочник',
                        'gostem' => 'Запись на гос. экзамены',
                        'employment' => 'Трудоустройство',
                    ),
                ),
            )
        ));
    ?>
</form>
