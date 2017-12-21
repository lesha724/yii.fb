<?php

$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'ps-appearance',
    'htmlOptions' => array('class' => 'form-horizontal'),
    'action' => '#'
));

$htmlOptions2 = array(
    'class'=>'ace',
);
?>
    <div class="control-group">
        <span class="lbl"> <?=tt('Количество дней для индикации (по умолчанию)')?>:</span>
        <?=CHtml::numberField('settings[108]', PortalSettings::model()->findByPk(108)->ps2)?>
    </div>

    <div class="control-group">
        <?php
            $needAuth = PortalSettings::MOBILE_APP_NEED_AUTH;
        ?>
        <?=CHtml::checkBox('', PortalSettings::model()->findByPk($needAuth)->ps2, $htmlOptions2)?>
        <span class="lbl"> <?=tt('Мобильное приложение через авторизацию')?></span>
        <?=CHtml::hiddenField('settings['.$needAuth.']', PortalSettings::model()->findByPk($needAuth)->ps2)?>
    </div>

    <div class="form-actions">
        <button type="submit" class="btn btn-info btn-small">
            <i class="icon-ok bigger-110"></i>
            <?=tt('Сохранить')?>
        </button>
    </div>

<?php $this->endWidget();?>