<?php

$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'ps-appearance',
    'htmlOptions' => array('class' => 'form-horizontal'),
    'action' => '#'
));

    $options = array(
        ' '.tt('Стандартный (сума балов)'),
        ' '.tt('Вариант 1 (ср. бал по занятиям * 12 + доп. балы)'),
    );

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
    <?php /*<div class="control-group">
        <?=CHtml::radioButtonList('settings[8]', PortalSettings::model()->findByPk(8)->ps2, $options, $htmlOptions)?>
    </div>*/ ?>

    <div class="control-group">
        <?=CHtml::radioButtonList('settings[44]', PortalSettings::model()->findByPk(44)->ps2, $options, $htmlOptions)?>
    </div>

    <div class="control-group">
        <?=CHtml::checkBox('', PortalSettings::model()->findByPk(9)->ps2, $htmlOptions2)?>
        <span class="lbl"> <?=tt('Учитывать min max')?></span>
        <?=CHtml::hiddenField('settings[9]', PortalSettings::model()->findByPk(9)->ps2)?>
    </div>

    <div class="control-group">
        <?=CHtml::checkBox('', PortalSettings::model()->findByPk(20)->ps2, $htmlOptions2)?>
        <span class="lbl"> <?=tt('Использовать субмодули')?></span>
        <?=CHtml::hiddenField('settings[20]', PortalSettings::model()->findByPk(20)->ps2)?>
    </div>

    <div class="control-group">
        <?=CHtml::checkBox('', PortalSettings::model()->findByPk(56)->ps2, $htmlOptions2)?>
        <span class="lbl"> <?=tt('Ввод оценок только типа "занятие"')?></span>
        <?=CHtml::hiddenField('settings[56]', PortalSettings::model()->findByPk(56)->ps2)?>
    </div>

    <div class="control-group">
        <?=CHtml::checkBox('', PortalSettings::model()->findByPk(57)->ps2, $htmlOptions2)?>
        <span class="lbl"> <?=tt('Обьединение с модулями')?></span>
        <?=CHtml::hiddenField('settings[57]', PortalSettings::model()->findByPk(57)->ps2)?>
    </div>

    <div class="control-group">
        <?=CHtml::checkBox('', PortalSettings::model()->findByPk(59)->ps2, $htmlOptions2)?>
        <span class="lbl"> <?=tt('Показывать кафедру')?></span>
        <?=CHtml::hiddenField('settings[59]', PortalSettings::model()->findByPk(59)->ps2)?>
    </div>

    <div class="control-group">
        <?=CHtml::checkBox('', PortalSettings::model()->findByPk(29)->ps2, $htmlOptions2)?>
        <span class="lbl"> <?=tt('Блокировать поле пересдач')?></span>
        <?=CHtml::hiddenField('settings[29]', PortalSettings::model()->findByPk(29)->ps2)?>
    </div>
    <?php /*
    <div class="control-group">
        <?=CHtml::checkBox('', PortalSettings::model()->findByPk(33)->ps2, $htmlOptions2)?>
        <span class="lbl"> <?=tt('Переводить в 200-бальную систему')?></span>
        <?=CHtml::hiddenField('settings[33]', PortalSettings::model()->findByPk(33)->ps2)?>
    </div> */?>

    <div class="control-group">
        <span class="lbl"> <?=tt('Количество дней на редактирование оценок')?>:</span>
        <?=CHtml::textField('settings[27]', PortalSettings::model()->findByPk(27)->ps2)?>
    </div>

    <div class="control-group">
        <span class="lbl"> <?=tt('Максимальный бал')?>:</span>
        <?=CHtml::numberField('settings[36]', PortalSettings::model()->findByPk(36)->ps2)?>
    </div>

    <div class="control-group">
        <span class="lbl"> <?=tt('Максимальный неудов. бал')?>:</span>
        <?=CHtml::numberField('settings[37]', PortalSettings::model()->findByPk(37)->ps2)?>
    </div>

    <div class="control-group">
        <?=CHtml::checkBox('', PortalSettings::model()->findByPk(55)->ps2, $htmlOptions2)?>
        <span class="lbl"> <?=tt('Вводить 0')?></span>
        <?=CHtml::hiddenField('settings[55]', PortalSettings::model()->findByPk(55)->ps2)?>
    </div>

    <div class="form-actions">
        <button type="submit" class="btn btn-info btn-small">
            <i class="icon-ok bigger-110"></i>
            <?=tt('Сохранить')?>
        </button>
    </div>

<?php $this->endWidget();?>