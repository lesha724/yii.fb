<?php
/**
 * Created by PhpStorm.
 * User: neffa
 * Date: 03.05.2018
 * Time: 16:03
 */

/** @var $model AttendanceStatisticForm */
/** @var $this JournalController */

$statistic=St::model()->getStatisticForStudent($model->student,$model->semester);
$st=St::model()->findByPk($model->student);
if(!$st)
    throw new CHttpException(400, tt('Не найден студент'));

echo '<div class="row-fluid">';

$text = tt('Пропуски студента:');
echo <<<HTML
<div class="span12">
    <h3 class="blue header lighter tooltip-info">
        {$text}
    </h3>
</div>
HTML;

$this->renderPartial('/journal/attendanceStatistic/_student', array(
    'statistic' => $statistic,
    'model'    => $model,
    'st'=>$st,
));

echo '</div>';