<?php
/**
 * Created by PhpStorm.
 * User: Neff
 * Date: 09.02.2016
 * Time: 11:22
 */

$options = array('class'=>'cs-select cs-skin-elastic','autocomplete' => 'off', 'empty' => '&nbsp;');

$form=$this->beginWidget('CActiveForm', array(
    'id'=>'filter-form',
    'htmlOptions' => array('class' => 'form-horizontal')
));

$html = '<div>';
$html .= '<fieldset>';
$filials = Ks::getListDataForKsFilter();
if (count($filials) > 1) {
    $html .= '<div class="select-group col-xs-12">';
    $html .= $form->label($model, 'filial');
    $html .= $form->dropDownList($model, 'filial', $filials, $options);
    $html .= '</div>';
}else{
    $model->filial = key($filials);
}

//$faculties = CHtml::listData(F::model()->getFacultiesFor($model->filial), 'f1', 'f3');
$faculties = F::model()->getFacultiesFor($model->filial);
$html .= '<div class="select-group col-xs-12">';
$html .= $form->label($model, 'faculty');
$html .= $form->dropDownList($model, 'faculty', $faculties, $options);
$html .= '</div>';


$courses = Sp::model()->getCoursesFor($model->faculty);
$html .= '<div class="select-group col-xs-6">';
$html .= $form->label($model, 'course');
$html .= $form->dropDownList($model, 'course', $courses, $options);
$html .= '</div>';


$groups = CHtml::listData(Gr::model()->getGroupsForTimeTable($model->faculty, $model->course), 'gr1', 'name');
$html .= '<div class="select-group col-xs-6">';
$html .= $form->label($model, 'group');
$html .= $form->dropDownList($model, 'group', $groups, $options);
$html .= '</div>';

$html .= '</fieldset>';
$html .= '</div>';
echo $html;
$this->endWidget();