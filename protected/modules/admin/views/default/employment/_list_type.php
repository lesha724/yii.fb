<?php

$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'ps-appearance',
    'htmlOptions' => array('class' => 'form-horizontal'),
    'action' => '#'
));

    $options = array(
        ' '.tt('Поток'),
        ' '.tt('По группам'),
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
        <?=CHtml::radioButtonList('settings[28]', PortalSettings::model()->findByPk(28)->ps2, $options, $htmlOptions)?>
    </div>

    <div class="form-actions">
        <button type="submit" class="btn btn-info btn-small">
            <i class="icon-ok bigger-110"></i>
            <?=tt('Сохранить')?>
        </button>
    </div>

<?php $this->endWidget();?>