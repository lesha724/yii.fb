<style>
    input.ace.ace-switch.ace-switch-6[type="checkbox"]:checked + .lbl:before {
        background-color: #468fcc;
    }
</style>
<?php
/**
 * @var ProgressController $this
 * @var FilterForm $model
 */

$options = array('class'=>'chosen-select', 'autocomplete' => 'off', 'empty' => '&nbsp;', 'style' => 'width:200px');

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

$tooltip = tt('Всего - кол-во пропусков всего').'&nbsp;&nbsp;&nbsp;'.
           tt('Ув - кол-во пропусков по уважительной причине').'&nbsp;&nbsp;&nbsp;';
$text = tt('в процентах');

$caption = <<<HTML
<h3 class="blue header lighter tooltip-info" >
    <i class="icon-info-sign"></i>
    <small>
        <i class="icon-double-angle-right"></i>
        {$tooltip}
    </small>
</h3>
HTML;



if (! empty($model->semester)) :

    echo $caption;

    $students = St::model()->getStudentsOfGroup($model->group);

    $this->renderPartial('attendanceStatistic/_table_1', array(
        'students' => $students
    ));

    $this->renderPartial('attendanceStatistic/_table_2Old', array(
        'students' => $students,
        'model'    => $model
    ));

endif;