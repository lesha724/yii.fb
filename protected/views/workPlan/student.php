<?php
/**
 *
 * @var WorkPlanController $this
 * @var TimeTableForm $model
 */

$this->pageHeader=tt('Рабочий план студента');
$this->breadcrumbs=array(
    tt('Рабочий план'),
);


Yii::app()->clientScript->registerPackage('spin');
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/workplan/student.js', CClientScript::POS_HEAD);

$this->renderPartial('/filter_form/student', array(
    'model' => $model,
    'showDateRangePicker' => false
));


echo <<<HTML
    <span id="spinner1"></span>
HTML;




/*if (! empty($model->student))
    $this->renderPartial('timeTable', array(
        'model'      => $model,
        'timeTable'  => $timeTable,
        'minMax'     => $minMax,
        'rz'         => $rz,
        'maxLessons' => array(),
    ));
*/