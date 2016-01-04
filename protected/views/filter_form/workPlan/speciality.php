<?php
/**
 *
 * @var FilterForm $model
 * @var CActiveForm $form
 */
$options = array('class'=>'chosen-select', 'autocomplete' => 'off', 'empty' => '&nbsp;');
$form=$this->beginWidget('CActiveForm', array(
    'id'=>'filter-form',
    'htmlOptions' => array('class' => 'form-inline')
));

    $html = '<div>';
    $html .= '<fieldset>';

    $filials = CHtml::listData(Ks::model()->findAllByAttributes(array('ks12'=>null,'ks13'=>0)), 'ks1', 'ks2');
    if (count($filials) > 1) {
        $html .= '<div class="span3 ace-select">';
        $html .= $form->label($model, 'filial');
        $html .= $form->dropDownList($model, 'filial', $filials, $options);
        $html .= '</div>';
    }

    $faculties = CHtml::listData(F::model()->getFacultiesFor($model->filial), 'f1', 'f3');
    $html .= '<div class="span3 ace-select">';
    $html .= $form->label($model, 'faculty');
    $html .= $form->dropDownList($model, 'faculty', $faculties, $options);
    $html .= '</div>';

    $specialities = CHtml::listData(Pnsp::model()->getSpecialitiesFor($model->faculty), 'pnsp1', 'name');
    $html .= '<div class="span3 ace-select">';
    $html .= $form->label($model, 'speciality');
    $html .= $form->dropDownList($model, 'speciality', $specialities, $options);
    $html .= '</div>';

    $courses = Sp::model()->getCoursesFor($model->faculty, $model->speciality);
    $html .= '<div class="span3 ace-select">';
    $html .= $form->label($model, 'course');
    $html .= $form->dropDownList($model, 'course', $courses, $options);
    $html .= '</div>';

    $groups = CHtml::listData(Gr::model()->getGroupsForWorkPlan($model), 'sg1', 'name');
    $html .= '<div class="span3 ace-select">';
    $html .= $form->label($model, 'group');
    $html .= $form->dropDownList($model, 'group', $groups, $options);
    $html .= '</div>';

    $html .= '</fieldset>';
    $html .= '</div>';

    echo $html;

$this->endWidget();