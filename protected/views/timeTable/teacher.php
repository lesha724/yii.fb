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


$form=$this->beginWidget('CActiveForm', array(
    'id'=>'tameTable-form',
));

$chairs = CHtml::listData(K::model()->getChairs($type), 'd1', 'd2');
echo $form->label($model, 'discipline');
echo $form->dropDownList($model, 'discipline', $disciplines, array('class'=>'chosen-select', 'autocomplete' => 'off', 'empty' => tt('&nbsp;')));

$groups = CHtml::listData(Gr::model()->getGroupsFor($model->discipline, $type), 'gr1', 'name');
echo $form->label($model, 'group');
echo $form->dropDownList($model, 'group', $groups, array('class'=>'chosen-select', 'autocomplete' => 'off', 'empty' => tt('&nbsp;')));

$this->endWidget();