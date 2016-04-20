<?php

$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'ps-appearance',
    'htmlOptions' => array('class' => 'form-horizontal'),
    'action' => '#'
));
    $htmlOptions = array(
        'class'=>'ace',
        'labelOptions' => array(
            'class' => 'lbl'
        )
    );


    $htmlOptions2 = array(
        'class'=>'ace',
    );
?>
    <div class="control-group">
        <?=CHtml::checkBox('', PortalSettings::model()->findByPk(64)->ps2, $htmlOptions2)?>
        <span class="lbl"> <?=tt('Скрывать фильтры')?></span>
        <?=CHtml::hiddenField('settings[64]', PortalSettings::model()->findByPk(64)->ps2)?>
    </div>

    <div class="control-group">
        <?=CHtml::checkBox('', PortalSettings::model()->findByPk(75)->ps2, $htmlOptions2)?>
        <span class="lbl"> <?=tt('Скрывать поиск для неавторизированных пользователей')?></span>
        <?=CHtml::hiddenField('settings[75]', PortalSettings::model()->findByPk(75)->ps2)?>
    </div>

    <div class="form-actions">
        <button type="submit" class="btn btn-info btn-small">
            <i class="icon-ok bigger-110"></i>
            <?=tt('Сохранить')?>
        </button>
    </div>

<?php $this->endWidget();?>