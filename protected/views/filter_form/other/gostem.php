<?php
/**
 *
 * @var OtherController $this
 * @var CActiveForm $form
 */

$options = array('class'=>'chosen-select', 'autocomplete' => 'off', 'empty' => '&nbsp;');
$form=$this->beginWidget('CActiveForm', array(
    'id'=>'filter-form',
    'htmlOptions' => array('class' => 'form-inline')
));

    $html = '<div>';
    $html .= '<fieldset>';

    list($chairs, $dataAttrs) = K::model()->getChairsForGostem();
    $chairs = CHtml::listData($chairs, 'nr1', 'name');
    $html .= '<div class="span3 ace-select">';
    $html .= $form->label($model, 'nr1');
    $html .= $form->dropDownList($model, 'nr1', $chairs, $options + array('options' => $dataAttrs));
    $html .= '</div>';

    $html .= $form->hiddenField($model, 'chair');
    $html .= $form->hiddenField($model, 'd1');

    $gostems = CHtml::listData(Gostem::model()->findAll('gostem2 = '.$model->chair.' and gostem3 = '.$model->d1), 'gostem1', 'gostem4');
    $html .= '<div class="span3 ace-select">';
    $html .= $form->label($model, 'gostem1');
    $html .= $form->dropDownList($model, 'gostem1', $gostems, $options);
    $html .= '</div>';

    $html .= '</fieldset>';
    $html .= '</div>';

    echo $html;

$this->endWidget();