<?php
/**
 * Created by PhpStorm.
 * User: Neff
 * Date: 07.12.2015
 * Time: 19:31
 */

$form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id'=>'kcp-form',
    'enableAjaxValidation'=>false,
    'action'=>Yii::app()->createUrl('/admin/default/createCloseChair'),
)); ?>

    <div class="alert alert-warning"><?=tt('Поля с ')?><span class="required">*</span><?=tt(' обязательны.')?></div>

<?php echo $form->errorSummary($model); ?>

	<?php echo $form->dropDownListRow($model,'kcp2',CHtml::listData(K::model()->getAllChairs(),'k1','k3'),array('class'=>'span11','maxlength'=>400)); ?>

    <div class="form-actions">
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
            'type'=>'primary',
            'label'=>tt('Создать'),
        )); ?>
    </div>

<?php $this->endWidget(); ?>