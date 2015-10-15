<?php
$this->pageHeader=tt('Отработка');
    $this->breadcrumbs=array(
        tt('Отработка'),
    );
Yii::app()->clientScript->registerPackage('gritter');
Yii::app()->clientScript->registerPackage('jquery.ui');
Yii::app()->clientScript->registerPackage('datepicker');
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/progress/retake.js', CClientScript::POS_HEAD);

$error       = tt('Ошибка! Проверьте правильность вводимых данных!');
$error_load       = tt('Ошибка! Ошибка загрузки данных!');
$success     = tt('Cохранено!');
$minMaxError = tt('Оценка за пределами допустимого интервала!');

Yii::app()->clientScript->registerScript('translations', <<<JS
    tt.error       = "{$error}"
    tt.error_load       = "{$error_load}"
    tt.success     = "{$success}"
    tt.minMaxError = "{$minMaxError}"
JS
, CClientScript::POS_READY);
        
$this->renderPartial('/filter_form/default/year_sem');

/*$form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'search-form',
    'htmlOptions' => array('class' => 'form-inline noprint'),
	'method'=>'post',
	'action'=> array('progress/filterStudent'),
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

$this->renderPartial('/filter_form/progress/retake', array(
        'model' => $model,
    ));*/

echo <<<HTML
    <span id="spinner1"></span>
HTML;

$this->renderPartial('retake/_bottom', array(
        'model' => $model,
        'retake'      => $retake
    ));

