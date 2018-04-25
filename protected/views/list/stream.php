<?php
/**
 * Created by PhpStorm.
 * User: Neff
 * Date: 02.12.2016
 * Time: 22:25
 */

/** @var $model FilterForm */
$this->pageHeader=tt('Список потока');
$this->breadcrumbs=array(
    tt('Список потока'),
);

Yii::app()->clientScript->registerPackage('dataTables');
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/list/stream.js', CClientScript::POS_HEAD);

$this->renderPartial('/filter_form/list/stream', array(
    'model' => $model,
));


echo <<<HTML
    <span id="spinner1"></span>
HTML;


if (! empty($model->stream))
    $this->renderPartial('stream/_bottom', array(
        'model' => $model,
    ));
