<?php

$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'ps-appearance',
    'htmlOptions' => array('class' => 'form-horizontal'),
    'action' => '#'
));

    $options = array(
        ' '.tt('Стандартный'),
        ' '.tt('C модулями'),
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
    <div class="control-group">
        <?=CHtml::radioButtonList('settings[8]', PortalSettings::model()->findByPk(8)->ps2, $options, $htmlOptions)?>
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
        <?=CHtml::checkBox('', PortalSettings::model()->findByPk(29)->ps2, $htmlOptions2)?>
        <span class="lbl"> <?=tt('Блокировать поле пересдач')?></span>
        <?=CHtml::hiddenField('settings[29]', PortalSettings::model()->findByPk(29)->ps2)?>
    </div>

    <div class="control-group">
        <span class="lbl"> <?=tt('Количество дней на редактирование оценок')?>:</span>
        <?=CHtml::textField('settings[27]', PortalSettings::model()->findByPk(27)->ps2)?>
    </div>

    <div class="form-actions">
        <button type="submit" class="btn btn-info btn-small">
            <i class="icon-ok bigger-110"></i>
            <?=tt('Сохранить')?>
        </button>
    </div>

<?php $this->endWidget();?>