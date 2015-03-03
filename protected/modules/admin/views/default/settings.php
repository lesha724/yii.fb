<?php
	$this->pageHeader=tt('Настройки');
	$this->breadcrumbs=array(
		tt('Админ. панель'),
	);
?>
<div class="form">
 <?php if(Yii::app()->user->hasFlash('config'))
		{ ?>
        <div class="alert in fade alert-success">
            <?php echo Yii::app()->user->getFlash('config'); ?>
        </div>
    <?php
	}else
	if(Yii::app()->user->hasFlash('config_error'))
		{ ?>
        <div class="alert in fade alert-danger">
            <?php echo Yii::app()->user->getFlash('config_error'); ?>
        </div>
    <?php
	}else
	{ 
		$form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
			'id'=>'config-form',
			'enableAjaxValidation'=>false,
			'htmlOptions' => array('class' => 'well'),
		)); ?>

    <?php echo $form->errorSummary($model); ?>

	<?php echo $form->DropDownListRow($model, 'attendanceStatistic',array('0'=>tt('По электронному журналу'),'1'=>'По деканату')); ?>
	
    <div class="form-actions">
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
            'type'=>'primary',
            'label'=>tt('Сохранить'),
        )); ?>
    </div>

<?php $this->endWidget(); 
	}
?>

