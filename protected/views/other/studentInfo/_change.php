<?php
        $form=$this->beginWidget('CActiveForm', array(
            'id'=>'attach-passport-form',
            'htmlOptions' => array(
                'enctype' => 'multipart/form-data',
            ),
            'method'=>'post',
            'action'=> array('/other/uploadPassport'),
        ));
    ?>

    <fieldset>
        <?= CHtml::fileField('document_psp', '', array('id' => 'id-passport-file')) ?>
        <?= CHtml::hiddenField('type',$type) ?>
        <?= CHtml::hiddenField('psp1', $psp1) ?>
    </fieldset>

    <div class="form-actions center">
        <button class="btn btn-small btn-success">
            <?=tt('Отправить')?>
            <i class="icon-arrow-right icon-on-right bigger-110"></i>
        </button>
    </div>
    <?php $this->endWidget(); ?>
