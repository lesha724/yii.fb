<?php
/**
 *
 * @var TimeTableController $this
 * @var TimeTableForm $model
 * @var CActiveForm $form
 */

$this->pageHeader=tt('Расписание академ. группы');
$this->breadcrumbs=array(
    tt('Расписание'),
);

Yii::app()->clientScript->registerPackage('chosen');
Yii::app()->clientScript->registerPackage('spin');
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/timetable/timetable.js', CClientScript::POS_HEAD);

$options = array('class'=>'chosen-select', 'autocomplete' => 'off', 'empty' => tt('&nbsp;'));
$form=$this->beginWidget('CActiveForm', array(
    'id'=>'timeTable-form',
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


    $courses = Sp::model()->getCoursesFor($model->faculty);
    $html .= '<div class="row-fluid span2">';
    $html .= $form->label($model, 'course');
    $html .= $form->dropDownList($model, 'course', $courses, $options);
    $html .= '</div>';


    $groups = CHtml::listData(Gr::model()->getGroupsForTimeTable($model->faculty, $model->course), 'gr1', 'name');
    $html .= '<div class="row-fluid span2">';
    $html .= $form->label($model, 'group');
    $html .= $form->dropDownList($model, 'group', $groups, $options);
    $html .= '</div>';

    $html .= $form->hiddenField($model, 'date1');
    $html .= $form->hiddenField($model, 'date2');
    $html .= '</fieldset>';

    $html .= '<fieldset style="margin-top:1%;">';
    $html .= $this->renderPartial('_date_interval', array(
        'date1' => $model->date1,
        'date2' => $model->date2,
        'r11'   => $model->r11,
    ), true);

    $html .= '<div class="row-fluid span3" style="margin-left: 0">';
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




if (! empty($model->group))
    $this->renderPartial('timeTable', array(
        'model'      => $model,
        'timeTable'  => $timeTable,
        'minMax'     => $minMax,
        'maxLessons' => $maxLessons,
        'rz'         => $rz,
    ));
