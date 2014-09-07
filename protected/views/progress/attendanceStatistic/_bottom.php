<?php
/**
 * @var ProgressController $this
 * @var FilterForm $model
 */


$options = array('class'=>'chosen-select', 'autocomplete' => 'off', 'empty' => tt('&nbsp;'), 'style' => 'width:200px');

$data = CHtml::listData(Sem::model()->getSemestersForAttendanceStatistic($model->group), 'us3', 'sem7', 'name');

$html  = '<div class="row-fluid" style="margin-bottom:2%">';
$html .= '<div style="width:20%; float:left">';
$html .= CHtml::label(tt('Семестр'), 'FilterForm_semester');
$html .= CHtml::dropDownList('FilterForm[semester]', $model->semester, $data, $options);
$html .= '</div>';

if ($model->semester) {
    $data = CHtml::listData(Sem::model()->getMonthsNamesForAttendanceStatistic($model->semester), 'firstDay', 'name');
    $html .= '<div>';
    $html .= CHtml::label(tt('Месяц'), 'FilterForm_month');
    $html .= CHtml::dropDownList('FilterForm[month]', $model->month, $data, $options);
    $html .= '</div>';
}
$html .= '</div>';
echo $html;

if (! empty($model->semester)) :

    $students = St::model()->getStudentsOfGroup($model->group);

    $this->renderPartial('attendanceStatistic/_table_1', array(
        'students' => $students
    ));

    $this->renderPartial('attendanceStatistic/_table_2', array(
        'students' => $students,
        'model'    => $model
    ));

    ?>

<?php endif ?>