<div class="span5">
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'pm-form',
	'enableAjaxValidation'=>false,
)); ?>
	<div class="alert alert-warning"><?=tt('Поля с ')?><span class="required">*</span><?=tt(' обязательны.')?></div>

	<?php echo $form->errorSummary($model); ?>

    <?php echo $form->errorSummary($parent); ?>

	<?php echo $form->textFieldRow($model,'pm2',array('class'=>'span12','maxlength'=>400)); ?>

	<?php echo $form->textFieldRow($model,'pm3',array('class'=>'span12','maxlength'=>400)); ?>

	<?php echo $form->textFieldRow($model,'pm4',array('class'=>'span12','maxlength'=>400)); ?>
        
    <?php echo $form->textFieldRow($model,'pm5',array('class'=>'span12','maxlength'=>400)); ?>

	<?php echo $form->labelEx($model, 'pm6'); ?>
    <?php echo $form->urlField($model,'pm6',array('class'=>'span12','maxlength'=>1020)); ?>
    <?php echo $form->error($model, 'pm6'); ?>
        
    <?php echo $form->checkBoxRow($model,'pm7'); ?>

    <?php echo $form->labelEx($model, 'pm8'); ?>
    <?php echo $form->dropDownListRow($model,'pm8',Pm::getPm8Array())?>
    <?php echo $form->error($model, 'pm8'); ?>


    <?php echo $form->labelEx($model, 'pm9'); ?>
    <?php echo $form->numberField($model,'pm9',array('class'=>'span12')); ?>
    <?php echo $form->error($model, 'pm9'); ?>
    <?php
        $style="display:none";
        $style1="";
        if(!empty($model->pm11))
            if($model->pm11!=0)
            {
                $style='';
                $style1="display:none";
            }
    ?>
    <div id="item_menu_group" style="<?=$style1?>">
        <?php echo $form->dropDownListRow($model,'pm10',Pm::getPm10Array(),array('class'=>'span5','maxlength'=>80)); ?>
    </div>
    <?php
    echo $form->dropDownListRow($model, 'pm11',Pm::getPm11Array(),array('id'=>'type-select'));

    Yii::app()->clientScript->registerScript('create-item-menu',"
	$(document).on('change','#type-select', function() {
            if($(this).val()!=0)
            {
                $('#item_menu_type').show();
                $('#item_menu_group').hide();
            }else
            {
                $('#item_menu_type').hide();
                $('#item_menu_group').show();
            }
        });",CClientScript::POS_READY);


    ?>
    <div id="item_menu_type" style="<?=$style?>">
        <?php echo $form->dropDownListRow($parent,'pmc1',CHtml::listData($model->getParents(),'pm1','pm2'))?>
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
