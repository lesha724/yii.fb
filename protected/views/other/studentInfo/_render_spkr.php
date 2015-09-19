<?php
/**
 * Created by PhpStorm.
 * User: Neff
 * Date: 18.09.15
 * Time: 23:55
 */

$form=$this->beginWidget('CActiveForm', array(
    'id'=>'spkr-form',
    'method'=>'post',
    'action'=> array('/other/addSpkr'),
));

$options=array('style'=>'width:95%');
?>

    <fieldset>
        <?php echo $form->label($model,'spkr2'); ?>
        <?php echo $form->textField($model,'spkr2',$options); ?>
        <?php echo $form->label($model,'spkr3'); ?>
        <?php echo $form->textField($model,'spkr3',$options); ?>
    </fieldset>

    <div class="form-actions center">
        <a class="btn btn-small btn-success">
            <?=tt('Сохранить')?>
            <i class="icon-arrow-right icon-on-right bigger-110"></i>
        </a>
    </div>
<?php $this->endWidget(); ?>