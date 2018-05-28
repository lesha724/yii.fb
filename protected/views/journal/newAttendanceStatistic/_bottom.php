<?php
/**
 * Created by PhpStorm.
 * User: neffa
 * Date: 03.05.2018
 * Time: 16:04
 */

/** @var $model AttendanceStatisticForm */
/** @var $this JournalController */

if($model->scenario == AttendanceStatisticForm::SCENARIO_STUDENT)
    $view = '_bottom_student';
else
    $view = '_bottom_other';

if($model->validate()) {
    $options = array('class'=>'chosen-select', 'autocomplete' => 'off', 'empty' => '&nbsp;');

    $html = '<div class="row-fluid" style="margin-bottom:2%">';
    $html .= '<div class="span2 ace-select">';
    $html .= CHtml::label(tt('Семестр'), 'AttendanceStatisticForm_semester');
    $html .= CHtml::dropDownList('AttendanceStatisticForm[semester]', $model->semester, $model->getSemesters(), $options);
    $html .= '</div>';
    $html .= '</div>';

    echo $html;

    if (!empty($model->semester)) :

        $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'button',
            'type'=>'primary',

            'icon'=>'print',
            'label'=>tt('Печать'),
            'htmlOptions'=>array(
                'class'=>'btn-small',
                'data-url'=>Yii::app()->createUrl('/journal/newAttendanceStatisticExcel', array('type' => $model->scenario, 'AttendanceStatisticForm[semester]'=>$model->semester)),
                'id'=>'btn-print-excel',
            )
        ));

        $this->renderPartial('newAttendanceStatistic/' . $view, array(
            'model' => $model
        ));
    endif;
}

