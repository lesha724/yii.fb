<?php
/**
 *
 * @var WorkPlanController $this
 * @var FilterForm $model
 */

$this->pageHeader=tt('Рабочий учебный план группы');
$this->breadcrumbs=array(
    tt('Рабочий учебный план'),
);

Yii::app()->clientScript->registerPackage('dataTables');
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/workPlan/main.js', CClientScript::POS_HEAD);

$this->renderPartial('/filter_form/timeTable/group', array(
    'model' => $model,
    'type'=>1,//тип для юрки показывать или нет факультет 5
    'showDateRangePicker' => false
));


echo <<<HTML
    <span id="spinner1"></span>
HTML;


if (! empty($model->group))
    $this->renderPartial('_bottom', array(
        'model' => $model,
        'type'  => WorkPlanController::GROUP
    ));
