<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id'=>'users-form',
    'enableAjaxValidation'=>false,
    'htmlOptions' => array('class' => 'well'),
)); ?>

<p class="alert in fade alert-info">Поля с<span class="required">*</span> обязательны.</p>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->textFieldRow($model,'u2',array('class'=>'span5','maxlength'=>255)); ?>

<?php echo $form->passwordFieldRow($model,'u3',array('class'=>'span5','maxlength'=>255)); ?>

<?php echo $form->emailFieldRow($model,'u4',array('class'=>'span5','maxlength'=>255)); ?>

<div class="form-actions">
    <?php $this->widget('bootstrap.widgets.TbButton', array(
        'buttonType'=>'submit',
        'type'=>'primary',
        'label'=>$model->isNewRecord ? tt('Создать') : tt('Сохранить'),
    )); ?>
</div>

<?php $this->endWidget(); ?>
