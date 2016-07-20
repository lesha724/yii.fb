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
}

$chairs = K::model()->getOnlyChairsFor($model->filial);
$html .= '<div class="select-group col-xs-12">';
$html .= $form->label($model, 'chair');
$html .= $form->dropDownList($model, 'chair', $chairs, $options);
$html .= '</div>';


$teachers = P::model()->getTeachersForTimeTable($model->chair);
$html .= '<div class="select-group col-xs-12">';
$html .= $form->label($model, 'teacher');
$html .= $form->dropDownList($model, 'teacher', $teachers, $options);
$html .= '</div>';


$html .= '</fieldset>';
$html .= '</div>';
echo $html;
$this->endWidget();