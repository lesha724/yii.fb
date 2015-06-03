<?php

$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'ps-appearance',
    'htmlOptions' => array('class' => 'form-horizontal'),
    'action' => '#'
));

    $htmlOptions = array(
        'class'=>'ace',
    );

    $translate = tt('Колонка');
    $pattern = <<<HTML
<div class="control-group">
    <label class="span4">{$translate} %s</label>
    <div class="span8">
        <span>
           %s
        </span>
    </div>
</div>
HTML;

    $inputStyle = array('placeholder' => tt('Название колонки'), 'class' => 'span12');

    $num   = '№1';
    $input = CHtml::textField('settings[17]', PortalSettings::model()->findByPk(17)->ps2, $inputStyle);
    echo sprintf($pattern, $num, $input);

    $num   = '№2';
    $input = CHtml::textField('settings[18]', PortalSettings::model()->findByPk(18)->ps2, $inputStyle);
    echo sprintf($pattern, $num, $input);

    $num   = '№3';
    $input = CHtml::textField('settings[19]', PortalSettings::model()->findByPk(19)->ps2, $inputStyle);
    echo sprintf($pattern, $num, $input);
?>

    <div class="control-group">
        <?=CHtml::checkBox('', PortalSettings::model()->findByPk(16)->ps2, $htmlOptions);?>
        <span class="lbl"> <?=tt('Учитывать min max')?></span>
        <?=CHtml::hiddenField('settings[16]', PortalSettings::model()->findByPk(16)->ps2)?>
    </div>

    <div class="form-actions">
        <button type="submit" class="btn btn-info btn-small">
            <i class="icon-ok bigger-110"></i>
            <?=tt('Сохранить')?>
        </button>
    </div>

<?php $this->endWidget();?>