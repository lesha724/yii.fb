<?php

/**
 * @var FilterForm $model
 * @var CActiveForm $form
 */

$options = array('class'=>'chosen-select', 'autocomplete' => 'off', 'empty' => '&nbsp;', 'style' => 'width:200px');

$form=$this->beginWidget('CActiveForm', array(
    'id'=>'filter-form',
    'htmlOptions' => array('class' => 'form-inline')
));

    $html  = '<div>';
        $html .= '<fieldset>';

        $filials = Ks::getListDataForKsFilter();
        if (count($filials) > 1) {
            $html .= '<div class="span2 ace-select">';
            $html .= $form->label($model, 'filial');
            $html .= $form->dropDownList($model, 'filial', $filials, $options);
            $html .= '</div>';
        }else{
            $model->filial = key($filials);
        }

        $chairs = K::model()->getOnlyChairsFor($model->filial);
        $html .= '<div class="span2 ace-select">';
        $html .= $form->label($model, 'chair');
        $html .= $form->dropDownList($model, 'chair', $chairs, $options);
        $html .= '</div>';

        $teachers = P::model()->getTeachersForTimeTable($model->chair);
        $html .= '<div class="span2 ace-select">';
        $html .= $form->label($model, 'teacher');
        $html .= $form->dropDownList($model, 'teacher', $teachers, $options);
        $html .= '</fieldset>';
    $html .= '</div>';


    echo $html;

$this->endWidget();