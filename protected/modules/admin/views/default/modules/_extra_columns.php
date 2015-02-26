<?php
    $translate = tt('Колонка');

    $pattern = <<<HTML
<div class="control-group">
    <label class="span4">{$translate} %s</label>
    <div class="span8">
        <span>
            <label>
                %s
                <span class="lbl"></span>
                %s
            </label>
        </span>
        <span>
           %s
        </span>
    </div>
</div>
HTML;


    $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id'=>'ps-extra-columns',
        'htmlOptions' => array('class' => 'form-horizontal'),
        'action' => '#'
    ));


    $checkboxStyle = array('class' => 'ace ace-switch ace-switch-4');
    $inputStyle    = array('placeholder' => tt('Название колонки'), 'class' => 'span12');

    $num = '№1';
    $checkbox = CHtml::checkBox('', PortalSettings::model()->findByPk(10)->ps2, $checkboxStyle);
    $hidden   = CHtml::hiddenField('settings[10]', PortalSettings::model()->findByPk(10)->ps2);
    $input    = CHtml::textField('settings[11]', PortalSettings::model()->findByPk(11)->ps2, $inputStyle);
    echo sprintf($pattern, $num, $checkbox, $hidden, $input);

    $num = '№2';
    $checkbox = CHtml::checkBox('', PortalSettings::model()->findByPk(12)->ps2, $checkboxStyle);
    $hidden   = CHtml::hiddenField('settings[12]', PortalSettings::model()->findByPk(12)->ps2);
    $input    = CHtml::textField('settings[13]', PortalSettings::model()->findByPk(13)->ps2, $inputStyle);
    echo sprintf($pattern, $num, $checkbox, $hidden, $input);

    $num = '№3';
    $checkbox = CHtml::checkBox('', PortalSettings::model()->findByPk(14)->ps2, $checkboxStyle);
    $hidden   = CHtml::hiddenField('settings[14]', PortalSettings::model()->findByPk(14)->ps2);
    $input    = CHtml::textField('settings[15]', PortalSettings::model()->findByPk(15)->ps2, $inputStyle);
    echo sprintf($pattern, $num, $checkbox, $hidden, $input);
?>

    <div class="form-actions">
        <button type="submit" class="btn btn-info btn-small">
            <i class="icon-ok bigger-110"></i>
            <?=tt('Сохранить')?>
        </button>
    </div>

<?php $this->endWidget();?>