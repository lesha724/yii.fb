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

    $specialities = CHtml::listData(Sp::model()->getSpecialitiesForFaculty($model->faculty), 'sp1', 'name');
    $html .= '<div class="row-fluid span2">';
    $html .= $form->label($model, 'speciality');
    $html .= $form->dropDownList($model, 'speciality', $specialities, $options);
    $html .= '</div>';

    list($years_of_admission, $dataAttrs) = Sem::model()->getYearsForThematicPlan($model->speciality);
    $years_of_admission = CHtml::listData($years_of_admission, 'sg1', 'name');
    $html .= '<div class="row-fluid span2">';
    $html .= $form->label($model, 'year');
    $html .= $form->dropDownList($model, 'year', $years_of_admission, $options + array('options' => $dataAttrs));
    $html .= '</div>';
    $html .= '</fieldset>';

    $html .= '<fieldset>';
    list($disciplines, $dataAttrs) = D::model()->getDisciplineBySg1($model->year);
    $disciplines = CHtml::listData($disciplines, 'uo1', 'd2');
    $html .= '<div class="row-fluid span2">';
    $html .= $form->label($model, 'discipline');
    $html .= $form->dropDownList($model, 'discipline', $disciplines, $options + array('options' => $dataAttrs));
    $html .= '</div>';

    $semesters = CHtml::listData(Sem::model()->getSemestersForThematicPlan($model->discipline), 'us1', 'name');
    $html .= '<div class="row-fluid span2">';
    $html .= $form->label($model, 'semester');
    $html .= $form->dropDownList($model, 'semester', $semesters, $options);
    $html .= '</div>';

    $html .= '</fieldset>';

    //if (! empty($model->semester)) {
        $html .= '<fieldset style="margin-top:2%;">';

        $html .= '<div class="row-fluid span2">';
        $html .= $form->label($model, 'duration');
        $html .= $form->textField($model, 'duration', array('class' => ''));
        $html .= '</div>';
        $html .= '&nbsp;&nbsp;';

        $chairId  = K::model()->getChairByUo1($model->discipline);
        $teachers = P::model()->getTeachersForTimeTable($chairId, 'pd1');
        $html .= '<div class="row-fluid span2">';
        $html .= $form->label($model, 'teacher');
        $html .= $form->dropDownList($model, 'teacher', $teachers, array('class'=>'chosen-select', 'autocomplete' => 'off', 'empty' => array('&nbsp;')));
        $html .= '</div>';

        $button =  <<<HTML
<div>
    <button class="btn btn-info btn-small">
        <i class="icon-key bigger-110"></i>
        %s
    </button>
</div>
HTML;
        $html .= sprintf($button, tt('Ок'));

        $html .= $form->hiddenField($model, 'code');

        $html .= '</fieldset>';
    //}
    $html .= '</div>';

echo $html;

$this->endWidget();