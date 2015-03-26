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
echo '<div class="noprint">';
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/timetable/timetable.js', CClientScript::POS_HEAD);
$this->renderPartial('/filter_form/timeTable/group', array(
    'model' => $model,
    'showDateRangePicker' => true
));
echo '</div>';
echo <<<HTML
    <span id="spinner1"></span>
HTML;



if (! empty($model->group))
	if($type==0)
		$this->renderPartial('/timeTable/schedule', array(
			'model'      => $model,
			'timeTable'  => $timeTable,
			'minMax'     => $minMax,
			'maxLessons' => $maxLessons,
			'rz'         => $rz,
		));
	else
		$this->renderPartial('/timeTable/calendar', array(
			'model'      => $model,
			'timeTable'  => $timeTable,
			'minMax'     => $minMax,
			'maxLessons' => $maxLessons,
			'rz'         => $rz,
		));
