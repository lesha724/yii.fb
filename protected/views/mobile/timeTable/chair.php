<?php
/**
 * Created by PhpStorm.
 * User: Neff
 * Date: 09.02.2016
 * Time: 11:00
 */
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/mobile/script/timetable/script.js', CClientScript::POS_HEAD);
Yii::app()->clientScript->registerPackage('datepicker-mobile');
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/mobile/datepicker/locales/bootstrap-datepicker.'.Yii::app()->language.'.min.js', CClientScript::POS_END);


$this->renderPartial('/filter_form/default/mobile/_accordion_select', array(
    'render' => '/filter_form/mobile/timeTableChair',
    'arr' => array('model' => $model)
));?>

<?php

if (! empty($model->chair)) {
    echo '<div id="time-table-chair">';
    $teachers = P::model()->getTeachersForTimeTableChair($model->chair);

    $this->renderPartial('timeTable/chair/_table', array(
        'model' => $model,
        'teachers'=>$teachers
    ));
    echo '</div">';
}else{
    $this->pageHeader=tt('Расписание кафедры');
    $this->breadcrumbs=array(
        tt('Расписание'),
    );
}