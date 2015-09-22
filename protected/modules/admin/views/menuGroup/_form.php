<div class="span5">
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'pmg-form',
	'enableAjaxValidation'=>false,
)); ?>

    <div class="alert alert-warning"><?=tt('Поля с ')?><span class="required">*</span><?=tt(' обязательны.')?></div>

    <?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'pmg2',array('class'=>'span5','maxlength'=>400)); ?>

	<?php echo $form->textFieldRow($model,'pmg3',array('class'=>'span5','maxlength'=>400)); ?>

	<?php echo $form->textFieldRow($model,'pmg4',array('class'=>'span5','maxlength'=>400)); ?>

	<?php echo $form->textFieldRow($model,'pmg5',array('class'=>'span5','maxlength'=>400)); ?>

    <?php echo $form->checkBoxRow($model,'pmg7'); ?>

    <?php echo $form->labelEx($model, 'pmg8'); ?>
    <?php echo $form->numberField($model,'pmg8',array('class'=>'span12')); ?>
    <?php echo $form->error($model, 'pmg8'); ?>

	<?php echo $form->textFieldRow($model,'pmg9',array('class'=>'span5','maxlength'=>400)); ?>

    <div class="form-actions">
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
            'type'=>'primary',
            'label'=>$model->isNewRecord ? tt('Создать') : tt('Сохранить'),
        )); ?>
    </div>

<?php $this->endWidget(); ?>
</div>
