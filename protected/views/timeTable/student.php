<?php
/**
 *
 * @var TimeTableController $this
 * @var TimeTableForm $model
 */

$this->pageHeader=tt('Расписание студента');
$this->breadcrumbs=array(
    tt('Расписание'),
);

Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/timetable/timetable.js', CClientScript::POS_HEAD);
if(!(PortalSettings::model()->findByPk(77)->ps2&&Yii::app()->user->isGuest)) {
	$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
			'id' => 'search-form',
			'htmlOptions' => array('class' => 'form-inline'),
			'method' => 'post',
			'action' => array('other/searchStudent', 'type' => 'timeTable'),
	));
	?>
	<?php echo $form->textField(new SearchStudentsForm(), 'name', array('size' => 60, 'maxlength' => 255, 'class' => 'search-by-name')); ?>

	<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType' => 'submit',
			'type' => 'primary',
			'icon' => 'search',
			'label' => tt('Поиск'),
			'htmlOptions' => array(
					'class' => 'btn-small'
			)
	)); ?>
	<?php
	$this->endWidget();
}

$this->renderPartial('/filter_form/timeTable/student', array(
    'model' => $model,
    'showDateRangePicker' => true,
	'type'=>$type,
	'showCheckBoxCalendar'=>true
));

Yii::app()->clientScript->registerScript('calendar-checkbox',"
				$(document).on('change', '#checkbox-timeTable', function(){
					if($(this).is(':checked')) {
						$('#timeTable').val(1);
					}else
					{
						$('#timeTable').val(0);
					}
					$(this).closest('form').submit();
				});
				$(document).on('click', '#sem-date', function(){
					$('#TimeTableForm_date1').val($(this).data('date1'));
					$('#TimeTableForm_date2').val($(this).data('date2'));
					$(this).closest('form').submit();
				});
		");
echo <<<HTML
    <span id="spinner1"></span>
HTML;

if (! empty($model->student))
	if($type==0)
		$this->renderPartial('schedule', array(
			'model'      => $model,
			'timeTable'  => $timeTable,
			'minMax'     => $minMax,
			'rz'         => $rz,
			'maxLessons' => $maxLessons,
            'action' =>'studentExcel'
		));
	else
		$this->renderPartial('/timeTable/calendar', array(
			'model'      => $model,
			'timeTable'  => $timeTable,
			'minMax'     => $minMax,
			'maxLessons' => $maxLessons,
			'rz'         => $rz,
		));
