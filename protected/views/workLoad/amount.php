<?php
/**
 *
 * @var WorkLoadController $this
 * @var FilterForm $model
 */

$this->pageHeader=tt('Объем учебной нагрузки преподавателя');
$this->breadcrumbs=array(
    tt('Объем учебной нагрузки'),
);

Yii::app()->clientScript->registerPackage('dataTables');
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/workLoad/main.js', CClientScript::POS_HEAD);

$this->renderPartial('/filter_form/default/teacher', array(
    'model' => $model,
));


echo <<<HTML
    <span id="spinner1"></span>
HTML;




if (! empty($model->teacher))
    $this->renderPartial('_bottom/_amount', array(
        'model' => $model,
    ));
