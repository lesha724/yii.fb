<?php
/**
 * Created by PhpStorm.
 * User: Neff
 * Date: 02.12.2016
 * Time: 22:25
 */

$this->pageHeader=tt('Список группы по выборочным дисциплинам');
$this->breadcrumbs=array(
    tt('Список виртуальной группы'),
);

Yii::app()->clientScript->registerPackage('dataTables');
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/list/virtual-group.js', CClientScript::POS_HEAD);

$this->renderPartial('/filter_form/default/year_sem');

$this->renderPartial('/filter_form/list/virtual-group', array(
    'model' => $model,
));


echo <<<HTML
    <span id="spinner1"></span>
HTML;


if (! empty($model->group))
    $this->renderPartial('virtual-group/_bottom', array(
        'model' => $model,
    ));
