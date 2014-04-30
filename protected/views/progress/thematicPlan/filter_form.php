<?php
/**
 *
 * @var ProgressController $this
 * @var FilterForm $model
 */

$options = array('class'=>'chosen-select', 'autocomplete' => 'off', 'empty' => tt('&nbsp;'));
$form=$this->beginWidget('CActiveForm', array(
    'id'=>'filter-form',
    'htmlOptions' => array('class' => 'form-inline')
));

    $html = '<div>';
    $html .= '<fieldset>';
    $filials = CHtml::listData(Ks::model()->findAll(), 'ks1', 'ks2');
    if (count($filials) > 1) {
        $html .= '<div class="row-fluid span2">';
        $html .= $form->label($model, 'filial');
        $html .= $form->dropDownList($model, 'filial', $filials, $options);
        $html .= '</div>';
    }

    $faculties = CHtml::listData(F::model()->getFacultiesFor($model->filial), 'f1', 'f3');
    $html .= '<div class="row-fluid span2">';
    $html .= $form->label($model, 'faculty');
    $html .= $form->dropDownList($model, 'faculty', $faculties, $options);
    $html .= '</div>';

    $specialities = CHtml::listData(Sp::model()->getSpecialititesForFaculty($model->faculty), 'sp1', 'name');
    $html .= '<div class="row-fluid span2">';
    $html .= $form->label($model, 'speciality');
    $html .= $form->dropDownList($model, 'speciality', $specialities, $options);
    $html .= '</div>';

    $years_of_admission = CHtml::listData(Sem::model()->getYearsForThematicPlan($model->speciality), 'sg1', 'name');
    $html .= '<div class="row-fluid span2">';
    $html .= $form->label($model, 'year_of_admission');
    $html .= $form->dropDownList($model, 'year_of_admission', $years_of_admission, $options);
    $html .= '</div>';
    $html .= '</fieldset>';


    $html .= '<fieldset>';
    $disciplines = CHtml::listData(D::model()->getDisciplineBySg1($model->year_of_admission), 'uo1', 'd2');
    $html .= '<div class="row-fluid span2">';
    $html .= $form->label($model, 'discipline');
    $html .= $form->dropDownList($model, 'discipline', $disciplines, $options);
    $html .= '</div>';

    $semesters = CHtml::listData(Sem::model()->getSemestersForThematicPlan($model->discipline), 'us1', 'name');
    $html .= '<div class="row-fluid span2">';
    $html .= $form->label($model, 'semester');
    $html .= $form->dropDownList($model, 'semester', $semesters, $options);
    $html .= '</div>';

    $html .= '</fieldset>';
    $html .= '</div>';

    echo $html;

$this->endWidget();