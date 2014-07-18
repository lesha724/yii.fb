<?php
/**
 *
 * @var WorkPlanController $this
 * @var TimeTableForm $model
 */

$this->pageHeader=tt('Нагрузка преподавателя');
$this->breadcrumbs=array(
    tt('Нагрузка'),
);

Yii::app()->clientScript->registerPackage('dataTables');
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/workLoad/main.js', CClientScript::POS_HEAD);


echo <<<HTML
    <span id="spinner1"></span>
HTML;


if (! empty($model->teacher))
    $this->renderPartial('_bottom', array(
        'model' => $model,
    ));
