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
    $checkbox = CHtml::checkBox('', PortalSettings::model()->findByPk(0)->ps2, $checkboxStyle);
    $hidden   = CHtml::hiddenField('settings[0]', PortalSettings::model()->findByPk(0)->ps2);
    $input    = CHtml::textField('settings[1]', PortalSettings::model()->findByPk(1)->ps2, $inputStyle);
    echo sprintf($pattern, $num, $checkbox, $hidden, $input);

    $num = '№2';
    $checkbox = CHtml::checkBox('', PortalSettings::model()->findByPk(2)->ps2, $checkboxStyle);
    $hidden   = CHtml::hiddenField('settings[2]', PortalSettings::model()->findByPk(2)->ps2);
    $input    = CHtml::textField('settings[3]', PortalSettings::model()->findByPk(3)->ps2, $inputStyle);
    echo sprintf($pattern, $num, $checkbox, $hidden, $input);

    $num = '№3';
    $checkbox = CHtml::checkBox('', PortalSettings::model()->findByPk(4)->ps2, $checkboxStyle);
    $hidden   = CHtml::hiddenField('settings[4]', PortalSettings::model()->findByPk(4)->ps2);
    $input    = CHtml::textField('settings[5]', PortalSettings::model()->findByPk(5)->ps2, $inputStyle);
    echo sprintf($pattern, $num, $checkbox, $hidden, $input);

    $num = '№4';
    $checkbox = CHtml::checkBox('', PortalSettings::model()->findByPk(6)->ps2, $checkboxStyle);
    $hidden   = CHtml::hiddenField('settings[6]', PortalSettings::model()->findByPk(6)->ps2);
    $input    = CHtml::textField('settings[7]', PortalSettings::model()->findByPk(7)->ps2, $inputStyle);
    echo sprintf($pattern, $num, $checkbox, $hidden, $input);
?>

    <div class="form-actions">
        <button type="submit" class="btn btn-info btn-small">
            <i class="icon-ok bigger-110"></i>
            <?=tt('Сохранить')?>
        </button>
    </div>

<?php $this->endWidget();?>