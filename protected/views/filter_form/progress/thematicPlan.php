<?php
/**
 *
 * @var ProgressController $this
 * @var FilterForm $model
 */

$options = array('class'=>'chosen-select', 'autocomplete' => 'off', 'empty' => '&nbsp;');
$form=$this->beginWidget('CActiveForm', array(
    'id'=>'filter-form',
    'htmlOptions' => array('class' => 'form-inline')
));

    $html = '<div>';
    $html .= '<fieldset>';
    $filials = CHtml::listData(Ks::model()->findAll(), 'ks1', 'ks2');
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

    //if (! empty($model->semester)) {
        /*$html .= '<fieldset style="margin-top:2%;">';

        $html .= '<div class="span3 ace-select">';
        $html .= $form->label($model, 'duration');
        $html .= $form->textField($model, 'duration', array('class' => ''));
        $html .= '</div>';
        $html .= '&nbsp;&nbsp;';

        $chairId  = K::model()->getChairByUo1($model->discipline);
        $teachers = P::model()->getTeachersForTimeTable($chairId, 'pd1');
        $html .= '<div class="span3 ace-select">';
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

        $html .= '</fieldset>';*/
    //}
    $html .= '</div>';

echo $html;

$this->endWidget();