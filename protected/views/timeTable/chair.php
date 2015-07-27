<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$this->pageHeader=tt('Расписание кафедры');
$this->breadcrumbs=array(
    tt('Расписание'),
);

Yii::app()->clientScript->registerPackage('jquery.ui');
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/timetable/timetable.js', CClientScript::POS_HEAD);

$attr = array('class'=>'chosen-select', 'autocomplete' => 'off', 'empty' => '&nbsp;');

$form=$this->beginWidget('CActiveForm', array(
    'id'=>'timeTable-form',
    'htmlOptions' => array('class' => 'form-inline noprint')
));

$html = '<div>';
    $html .= '<fieldset>';
    $filials = CHtml::listData(Ks::model()->findAll(), 'ks1', 'ks2');
    if (count($filials) > 1) {
        $html .= '<div class="span3 ace-select">';
        $html .= $form->label($model, 'filial');
        $html .= $form->dropDownList($model, 'filial', $filials, $attr);
        $html .= '</div>';
    }

    $chairs = CHtml::listData(K::model()->getOnlyChairsFor($model->filial), 'k1', 'k3');
    $html .= '<div class="span3 ace-select">';
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

echo <<<HTML
    <span id="spinner1"></span>
HTML;

if (! empty($model->chair)) {
    echo '<div id="time-table-chair">';
    $teachers = P::model()->getTeachersForTimeTableChair($model->chair);
    if(!empty($teachers)){
        $this->renderPartial('chair/_table1', array(
                'model'      => $model,
                'teachers'      => $teachers
        ));
        $this->renderPartial('chair/_table2', array(
            'model'      => $model,
            'teachers'      => $teachers
        ));
    }
    echo '</div>';
}