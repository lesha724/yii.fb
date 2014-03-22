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
echo CHtml::radioButtonList('settings[8]', PortalSettings::model()->findByPk(8)->ps2, $options, $htmlOptions);
?>
    <div class="form-actions">
        <button type="submit" class="btn btn-info btn-small">
            <i class="icon-ok bigger-110"></i>
            <?=tt('Сохранить')?>
        </button>
    </div>

<?php $this->endWidget();?>