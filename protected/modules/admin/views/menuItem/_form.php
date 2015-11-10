<div class="span5">
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'pm-form',
	'enableAjaxValidation'=>false,
)); ?>
	<div class="alert alert-warning"><?=tt('Поля с ')?><span class="required">*</span><?=tt(' обязательны.')?></div>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'pm2',array('class'=>'span12','maxlength'=>400)); ?>

	<?php echo $form->textFieldRow($model,'pm3',array('class'=>'span12','maxlength'=>400)); ?>

	<?php echo $form->textFieldRow($model,'pm4',array('class'=>'span12','maxlength'=>400)); ?>
        
    <?php echo $form->textFieldRow($model,'pm5',array('class'=>'span12','maxlength'=>400)); ?>

	<?php echo $form->labelEx($model, 'pm6'); ?>
    <?php echo $form->urlField($model,'pm6',array('class'=>'span12','maxlength'=>1020)); ?>
    <?php echo $form->error($model, 'pm6'); ?>
        
    <?php echo $form->checkBoxRow($model,'pm7'); ?>

    <?php echo $form->checkBoxRow($model,'pm8'); ?>

	<?php echo $form->labelEx($model, 'pm9'); ?>
    <?php echo $form->numberField($model,'pm9',array('class'=>'span12')); ?>
    <?php echo $form->error($model, 'pm9'); ?>

	<?php echo $form->dropDownListRow($model,'pm10',Pm::getPm10Array(),array('class'=>'span5','maxlength'=>80)); ?>

    <?php
    echo $form->DropDownListRow($model, 'pm11',Pm::getPm11Array(),array('id'=>'type-select'));

    Yii::app()->clientScript->registerScript('create-item-menu',"
	$(document).on('change','#type-select', function() {
            if($(this).val()!=0)
            {
                $('#item_menu_type').show();
            }else
            {
                $('#item_menu_type').hide();
            }
        });",CClientScript::POS_READY);

    $style="display:none";
    if(!empty($model->pm11))
        if($model->pm11!=0)
            $style='';
    ?>
    <div id="item_menu_type" style="<?=$style?>">
        <?php echo $form->dropDownListRow($parent,'pmc2',CHtml::listData($model->getParents(),'pm1','pm2'))?>
    </div>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? tt('Создать') : tt('Сохранить'),
		)); ?>
	</div>

<?php $this->endWidget(); ?>
</div>
