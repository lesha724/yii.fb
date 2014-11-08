<?php
/**
 * @var OtherController $this
 * @var FilterForm $model
 */
$this->pageHeader=tt('Трудоустройство');
$this->breadcrumbs=array(
    tt('Трудоустройство'),
);

Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/other/employment.js', CClientScript::POS_HEAD);

$data    = array(tt('Студенты'), tt('Выпускники'));
$options = array('class'=>'chosen-select', 'autocomplete' => 'off', 'empty' => '&nbsp;', 'style' => 'width:200px');

$html  = '<div class="row-fluid" style="margin-bottom:2%">';
$html .= CHtml::label(tt('Категория'), 'FilterForm_category');
$html .= CHtml::dropDownList('FilterForm[category]', $model->category, $data, $options);
$html .= '</div>';
echo $html;

echo <<<HTML
    <span id="spinner1"></span>
HTML;

if ($model->category == 0) {
    $this->renderPartial('/filter_form/workPlan/speciality', array(
        'model' => $model,
    ));
} elseif ($model->category == 1) {
    $this->renderPartial('/filter_form/other/graduate', array(
        'model' => $model,
    ));

}


if (! empty($model->group)) {
    $students = St::model()->getStudentsForEmployment($model);
    $this->renderPartial('employment/_bottom', array(
        'model' => $model,
        'students' => $students
    ));
}

