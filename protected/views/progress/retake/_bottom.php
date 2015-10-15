<?php
/**
 *
 * @var ProgressController $this
 * @var $model FilterForm
 */

$options = array('class'=>'chosen-select', 'autocomplete' => 'off', 'empty' => '&nbsp;', 'style' => 'width:200px');
$form=$this->beginWidget('CActiveForm', array(
    'id'=>'filter-form',
    'htmlOptions' => array('class' => 'form-inline')
));

$html  ='<div class="row-fluid">';
$disciplines = CHtml::listData(D::model()->getDisciplinesForRetakePermition(), 'd1', 'name');
$html .= '<div class="span3 ace-select">';
$html .= $form->label($model, 'discipline');
$html .= $form->dropDownList($model, 'discipline', $disciplines, $options);
$html .= '</div>';
$types = CHtml::listData(D::model()->getUsFromDiscipline($model->discipline), 'us1', 'name');
$html .= '<div class="span3 ace-select">';
$html .= $form->label($model, 'type_lesson');
$html .= $form->dropDownList($model, 'type_lesson', $types, $options);
$html .= '</div>';
echo $html;

$this->endWidget();

if (!empty($model->type_lesson)) {
    $this->renderPartial('/filter_form/default/_refresh_filter_form_button');
    $retake->stegn2=$model->type_lesson;
    $this->renderPartial('retake/_grid', array(
        'model' =>  $retake
    ));
} ?>