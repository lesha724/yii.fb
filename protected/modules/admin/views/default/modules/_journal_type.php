<?php

$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'ps-appearance',
    'htmlOptions' => array('class' => 'form-horizontal'),
    'action' => '#'
));

    $htmlOptions = array(
        'class'=>'ace',
    );

?>

    <div class="control-group">
        <?=CHtml::checkBox('', PortalSettings::model()->findByPk(42)->ps2, $htmlOptions);?>
        <span class="lbl"> <?=tt('Показывать таблицу 3')?></span>
        <?=CHtml::hiddenField('settings[42]', PortalSettings::model()->findByPk(42)->ps2)?>
    </div>

    <div class="form-actions">
        <button type="submit" class="btn btn-info btn-small">
            <i class="icon-ok bigger-110"></i>
            <?=tt('Сохранить')?>
        </button>
    </div>

<?php $this->endWidget();?>