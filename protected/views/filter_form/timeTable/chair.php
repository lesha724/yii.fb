<?php
/**
 * Created by PhpStorm.
 * User: Neff
 * Date: 19.08.2016
 * Time: 18:32
 */


$attr = array('class'=>'chosen-select', 'autocomplete' => 'off', 'empty' => '&nbsp;');

$form=$this->beginWidget('CActiveForm', array(
    'id'=>'timeTable-form',
    'htmlOptions' => array('class' => 'form-inline noprint')
));

$html = '<div>';
$html .= '<fieldset>';

$filials = Ks::getListDataForKsFilter();
if (count($filials) > 1) {
    $html .= '<div class="span2 ace-select">';
    $html .= $form->label($model, 'filial');
    $html .= $form->dropDownList($model, 'filial', $filials, $attr);
    $html .= '</div>';
}else{
    $model->filial = key($filials);
}

//$chairs = CHtml::listData(K::model()->getOnlyChairsFor($model->filial), 'k1', 'k3');
$chairs = K::model()->getOnlyChairsFor($model->filial);
$html .= '<div class="span2 ace-select">';
$html .= $form->label($model, 'chair');
$html .= $form->dropDownList($model, 'chair', $chairs, $attr);
$html .= '</div>';

$html .= $form->hiddenField($model, 'date1');
$html .= $form->hiddenField($model, 'date2');
$html .= '</fieldset>';

$html .= '<fieldset style="margin-top:1%;">';
$html .= $this->renderPartial('_date_interval', array(
    'date1' => $model->date1,
    'date2' => $model->date2,
    'r11'   => $model->r11,
    'showSem'=>true,
    'teacher'=>$model->teacher,
), true);

$html .= '<div class="span3 ace-block">';
$html .= $form->label($model, 'r11');
$html .= ' '.$form->textField($model, 'r11', array('class'=>'input-mini span2', 'placeholder' => tt('дней'), 'style'=>'background:'.TimeTableForm::r11Color));
$html .= '</div>';
$html .= '</fieldset>';
$html .= '</div>';

echo $html;

$this->endWidget();