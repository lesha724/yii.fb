<?php

$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'ps-appearance',
    'htmlOptions' => array('class' => 'form-horizontal'),
    'action' => '#'
));
$arr=array('0'=>tt('По электронному журналу'),'1'=>tt('По деканату'));
?>

    <div class="control-group">
        <span class="lbl"> <?=tt('По')?>:</span>
        <?=CHtml::dropDownList('settings[41]', PortalSettings::model()->findByPk(41)->ps2,$arr)?>
    </div>

    <div class="form-actions">
        <button type="submit" class="btn btn-info btn-small">
            <i class="icon-ok bigger-110"></i>
            <?=tt('Сохранить')?>
        </button>
    </div>

<?php $this->endWidget();?>