<?php
/**
 *
 * @var EntranceController $this
 * @var CActiveForm $form
 */

$options = array('class'=>'chosen-select', 'autocomplete' => 'off', 'empty' => '&nbsp;', 'style' => 'width:150px');
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

    $sel_1 = array(
        0 => tt('Младший специалист'),
        1 => tt('Бакалавр'),
        2 => tt('Специалист'),
        3 => tt('Магистр'),
    );
    $html .= '<div class="span3 ace-select">';
    $html .= $form->label($model, 'sel_1');
    $html .= $form->dropDownList($model, 'sel_1', $sel_1, $options);
    $html .= '</div>';


    $sel_2 = array(
        0 => tt('Дневная'),
        1 => tt('Заочная'),
    );
    if (! SH::is(U_NULAU))
        $sel_2 += array(2 => tt('Вечерняя'));
    $sel_2 += array(3 => tt('Экстернат'));

    $html .= '<div class="span3 ace-select">';
    $html .= $form->label($model, 'sel_2');
    $html .= $form->dropDownList($model, 'sel_2', $sel_2, $options);
    $html .= '</div>';


    $html .= '<div class="span3 ace-select">';
    $html .= $form->label($model, 'extendedForm');
    $html .= '<br/><label>';
    $html .= CHtml::checkBox('FilterForm[extendedForm]', $model->extendedForm, array('class' => 'ace ace-switch ace-switch-6')); 
    $html .= '<span class="lbl"></span>';
    $html .= '</label>';
    $html .= '</div>';

    if (SH::is(U_BSAA)) {
        $html .= $form->hiddenField($model, 'course', array('value' => 1));
    } else {
        $courses = CHtml::listData(Spab::model()->getCoursesForEntrance($model), 'spab6', 'spab6');
        $html .= '<div class="span3 ace-select">';
        $html .= $form->label($model, 'course');
        $html .= $form->dropDownList($model, 'course', $courses, $options);
        $html .= '</div>';
    }

    $button =  <<<HTML
    <div class="span3 ace-select" style="padding:23px 0 0 0">
        <button class="btn btn-info btn-small">
            <i class="icon-key bigger-110"></i>
            %s
        </button>
    </div>
HTML;
    $html .= sprintf($button, tt('Ок'));

    $html .= '</fieldset>';
    $html .= '</div>';

    echo $html;

$this->endWidget();
