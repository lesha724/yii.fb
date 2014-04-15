<?php
/**
 *
 * @var TimeTableController $this
 * @var TimeTableForm $model
 */

$this->pageHeader=tt('Расписание преподавателя');
$this->breadcrumbs=array(
    tt('Расписание'),
);

Yii::app()->clientScript->registerPackage('chosen');
Yii::app()->clientScript->registerPackage('spin');
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/timetable/timetable.js', CClientScript::POS_HEAD);

$form=$this->beginWidget('CActiveForm', array(
    'id'=>'tameTable-form',
));

    $filials = CHtml::listData(Ks::model()->findAll(), 'ks1', 'ks2');

    if (count($filials) > 1) {
        echo $form->label($model, 'filial');
        echo $form->dropDownList($model, 'filial', $filials, array('class'=>'chosen-select', 'autocomplete' => 'off', 'empty' => tt('&nbsp;')));
    }

    $chairs = CHtml::listData(K::model()->getOnlyChairsFor($model->filial), 'k1', 'k2');

    echo $form->label($model, 'chair');
    echo $form->dropDownList($model, 'chair', $chairs, array('class'=>'chosen-select', 'autocomplete' => 'off', 'empty' => tt('&nbsp;')));

$this->endWidget();