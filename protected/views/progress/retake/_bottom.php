<?php
/**
 *
 * @var ProgressController $this
 * @var $model FilterForm
 */

$options = array('class'=>'chosen-select', 'autocomplete' => 'off', 'empty' => '&nbsp;', 'style' => 'width:200px');
$html  ='<div class="row-fluid">';
$disciplines = CHtml::listData(D::model()->getDisciplineForRetake($model->group), 'us1', 'name');
$html .='<div class="span3 ace-select">'.
		CHtml::label($model->getAttributeLabel('discipline'), 'FilterForm_discipline').
		CHtml::dropDownList('FilterForm[discipline]', $model->discipline, $disciplines,$options).
	'</div>';
echo $html;

if (!empty($model->discipline)) {
    $this->renderPartial('/filter_form/default/_refresh_filter_form_button');
    $retake->stegn2=$model->discipline;
    $this->renderPartial('retake/_grid', array(
        'model' =>  $retake
    ));
} ?>