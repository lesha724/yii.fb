<?php
/**
 *
 * @var TimeTableController $this
 * @var TimeTableForm $model
 */

$this->pageHeader=tt('Расписание студента');
$this->breadcrumbs=array(
    tt('Расписание'),
);

Yii::app()->clientScript->registerPackage('spin');
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/timetable/timetable.js', CClientScript::POS_HEAD);

$this->renderPartial('/filter_form/student', array(
    'model' => $model,
    'showDateRangePicker' => true
));


echo <<<HTML
    <span id="spinner1"></span>
HTML;




if (! empty($model->student))
    $this->renderPartial('timeTable', array(
        'model'      => $model,
        'timeTable'  => $timeTable,
        'minMax'     => $minMax,
        'rz'         => $rz,
        'maxLessons' => array(),
    ));
