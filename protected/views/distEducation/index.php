<?php
/* @var $this DistEducationController */
/* @var $model DistEducationFilterForm */

Yii::app()->clientScript->registerPackage('gritter');
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/distEducation/index.js', CClientScript::POS_HEAD);


$this->pageHeader=tt('Дистанционое образование: закрепление дисциплин');
$this->breadcrumbs=array(
    tt('Дистанционое образование'),
);

$this->renderPartial('/filter_form/default/year_sem');

$chairId = $model->chairId;

if($model->isAdminDistEducation){
    echo '<form class="form-inline" id="filter-year-sem-form" method="POST">';
    $chairs = CHtml::listData(K::model()->getAllChairs(), 'k1', 'k3');
    //echo CHtml::label(tt('Кафедра'), 'chairs');
    echo CHtml::dropDownList('chairId', $chairId, $chairs, array('class'=>'chosen-select chosen-chairId', 'autocomplete' => 'off', 'empty' => ''));
    echo '</form>';
}else{
    if(!empty($model->chair))
        echo '<h4>'.$model->chair->k3.'</h4>';
}

if(!empty($chairId)):

    $this->renderPartial('_bottom', array(
        'model' => $model
    ));

endif;