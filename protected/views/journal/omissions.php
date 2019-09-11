<?php
/**
 *
 * @var TimeTableController $this
 * @var TimeTableForm $model
 */
$this->pageHeader=tt('Регистрация пропусков занятий');
$this->breadcrumbs=array(
    tt('Электронный журнал'),
);
Yii::app()->clientScript->registerPackage('dataTables');
Yii::app()->clientScript->registerPackage('gritter');
Yii::app()->clientScript->registerPackage('jquery.ui');
Yii::app()->clientScript->registerPackage('datepicker');
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/journal/omissions.js', CClientScript::POS_HEAD);

    $error       = tt('Ошибка! Проверьте правильность вводимых данных!');
    $success     = tt('Cохранено!');

    Yii::app()->clientScript->registerScript('translations', <<<JS
        tt.error       = "{$error}"
        tt.success     = "{$success}"
JS
    , CClientScript::POS_READY);

$this->renderPartial('/filter_form/default/year_sem');

$form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'search-form',
    'htmlOptions' => array('class' => 'form-inline'),
	'method'=>'post',
	'action'=> array('other/searchStudent', 'type' => 'ommisions'),
));
?>
	<?php echo $form->textField(new SearchStudentsForm(),'name',array('size'=>60,'maxlength'=>255,'class'=>'search-by-name')); ?>
	
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

$this->renderPartial('/filter_form/journal/omissions', array(
    'model' => $model,
    'showDateRangePicker' => true
));

echo <<<HTML
    <span id="spinner1"></span>
HTML;

if (! empty($model->student))
{
    $this->renderPartial('/filter_form/default/_refresh_filter_form_button');
    $this->renderPartial('/journal/omissions/_bottom', array(
            'model'      => $model,
    ));
}
