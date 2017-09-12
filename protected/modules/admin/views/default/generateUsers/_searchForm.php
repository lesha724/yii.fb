<?php
/**
 * Created by PhpStorm.
 * User: Neff
 * Date: 11.09.2017
 * Time: 17:18
 */
/*
$courses = array(
        1=>'1',
        2=>'2',
        3=>'3',
        4=>'4',
        5=>'5',
        6=>'6'
);
$form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id'=>'add-users-form',
    'enableAjaxValidation'=>false,
)); ?>

    <?php <div class="alert alert-warning"><?=tt('Поля с ')?><span class="required">*</span><?=tt(' обязательны.')?></div>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->dropDownListRow($model,'type',GenerateUserForm::getTypes(),array('class'=>'span11','maxlength'=>400)); ?>

    <div class="well">

        <?php echo $form->dropDownListRow($model,'faculty',CHtml::listData(F::model()->getAllFaculties(),'f1','f3'),array('empty' => '--Select a faculty--','class'=>'span11','maxlength'=>400)); ?>

        <?php echo $form->dropDownListRow($model,'speciality',CHtml::listData(Sp::model()->getAllSpecialities(), 'sp1','name'),array('empty' => '--Select a speciality--','class'=>'span11','maxlength'=>400)); ?>

        <?php echo $form->dropDownListRow($model,'course',$courses,array('empty' => '--Select a course--','class'=>'span11','maxlength'=>400)); ?>

    </div>

    <div class="well">

        <?php echo $form->dropDownListRow($model,'chair',CHtml::listData(K::model()->getAllChairs(),'k1','k3'),array('empty' => '--Select a chair--','class'=>'span11','maxlength'=>400)); ?>

    </div>

    <div class="form-actions">
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
            'type'=>'primary',
            'label'=>tt('Фильтровать'),
        )); ?>
    </div>

<?php $this->endWidget(); ?>*/