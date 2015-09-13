<?php
/**
 *
 * @var TimeTableController $this
 * @var TimeTableForm $model
 */

$this->pageHeader=tt('Регистрация пропусков занятий
');
$this->breadcrumbs=array(
    tt('Регистрация пропусков занятий
'),
);
Yii::app()->clientScript->registerPackage('dataTables');
Yii::app()->clientScript->registerPackage('gritter');
Yii::app()->clientScript->registerPackage('jquery.ui');
Yii::app()->clientScript->registerPackage('datepicker');
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/progress/omissions.js', CClientScript::POS_HEAD);

    $error       = tt('Ошибка! Проверьте правильность вводимых данных!');
    $success     = tt('Cохранено!');

    Yii::app()->clientScript->registerScript('translations', <<<JS
        tt.error       = "{$error}"
        tt.success     = "{$success}"
JS
    , CClientScript::POS_READY);
        
$form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'search-form',
    'htmlOptions' => array('class' => 'form-inline noprint'),
	'method'=>'post',
	'action'=> array('progress/searchStudent'),
));
?>
	<?php echo $form->textField($student,'st2',array('size'=>60,'maxlength'=>255)); ?>
	
	<?php $this->widget('bootstrap.widgets.TbButton', array(
		'buttonType'=>'submit',
		'type'=>'primary',
		'icon'=>'search',
		'label'=>tt('Поиск'),
		'htmlOptions'=>array(
			'class'=>'btn-small'
		)
	)); ?>
	<?php
$this->endWidget();

echo '<div class="noprint">';
$this->renderPartial('/filter_form/timeTable/omissions', array(
    'model' => $model,
    'showDateRangePicker' => true
));
echo '</div>';

echo <<<HTML
    <span id="spinner1"></span>
HTML;




if (! empty($model->student))
    $this->renderPartial('/progress/omissions/_bottom', array(
            'model'      => $model,
    ));
