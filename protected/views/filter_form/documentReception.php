<?php
/**
 *
 * @var EntranceController $this
 * @var CActiveForm $form
 */

$options = array('class'=>'chosen-select', 'autocomplete' => 'off', 'empty' => tt('&nbsp;'));
$form=$this->beginWidget('CActiveForm', array(
    'id'=>'filter-form',
    'htmlOptions' => array('class' => 'form-inline')
));

    $html = '<div>';
    $html .= '<fieldset>';

    $sel_1 = array(
        0 => tt('Младший специалист'),
        1 => tt('Бакалавр'),
        2 => tt('Специалист'),
        3 => tt('Магистр'),
    );
    $html .= '<div class="row-fluid span2">';
    $html .= $form->label($model, 'sel_1');
    $html .= $form->dropDownList($model, 'sel_1', $sel_1, $options);
    $html .= '</div>';


    $sel_2 = array(
        0 => tt('Дневная'),
        3 => tt('Экстернат'),
        1 => tt('Заочная'),
        2 => tt('Вечерняя'),
    );
    $html .= '<div class="row-fluid span2">';
    $html .= $form->label($model, 'sel_2');
    $html .= $form->dropDownList($model, 'sel_2', $sel_2, $options);
    $html .= '</div>';


    $html .= '<div class="row-fluid span2">';
    $html .= $form->label($model, 'extendedForm');
    $html .= '<br/><label>';
    $html .= CHtml::checkBox('FilterForm[extendedForm]', $model->extendedForm, array('class' => 'ace ace-switch ace-switch-6')); 
    $html .= '<span class="lbl"></span>';
    $html .= '</label>';
    $html .= '</div>';

    $course = CHtml::listData(Spab::model()->getCoursesForDocumentReception($model->sel_1, $model->sel_2), 'spab6', 'spab6');
    $html .= '<div class="row-fluid span2">';
    $html .= $form->label($model, 'course');
    $html .= $form->dropDownList($model, 'course', $course, $options);    
    $html .= '</div>';

    $button =  <<<HTML
    <div class="row-fluid span2" style="padding:23px 0 0 0">
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
