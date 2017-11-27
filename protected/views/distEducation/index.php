<?php
/* @var $this DistEducationController */
/* @var $user WebUser */
/* @var $chair K|null */

Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/distEducation/index.js', CClientScript::POS_HEAD);


$this->pageHeader=tt('Дистанционое образование');
$this->breadcrumbs=array(
    tt('Дистанционое образование: закрепление дисциплин'),
);

$this->renderPartial('/filter_form/default/year_sem');

$chairId = !empty($chair) ? $chair->k1 : null;

if($user->isAdmin){
    echo '<form class="form-inline" id="filter-year-sem-form" method="POST">';
    $chairs = CHtml::listData(K::model()->getAllChairs(), 'k1', 'k3');
    //echo CHtml::label(tt('Кафедра'), 'chairs');
    echo CHtml::dropDownList('chairId', $chairId, $chairs, array('class'=>'chosen-select chosen-chairId', 'autocomplete' => 'off', 'empty' => ''));
    echo '</form>';
}

if(!empty($chairId)):



endif;