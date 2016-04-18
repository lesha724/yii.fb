<?php
/**
 * Created by PhpStorm.
 * User: Neff
 * Date: 25.12.2015
 * Time: 10:11
 */

$htmlOptions2 = array(
    'class'=>'ace',
);

$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'ps-student-card-access',
    'htmlOptions' => array('class' => 'form-horizontal form-settings'),
    'action' => '#'
));

?>

    <div class="control-group">
        <?=CHtml::checkBox('settings[73]', PortalSettings::model()->findByPk(73)->ps2, $htmlOptions2)?>
        <span class="lbl"> <?=tt('Показывать для студентов')?></span>
        <?=CHtml::hiddenField('settings[73]', PortalSettings::model()->findByPk(73)->ps2)?>
    </div>

    <div class="control-group">
        <?=CHtml::checkBox('settings[74]', PortalSettings::model()->findByPk(74)->ps2, $htmlOptions2)?>
        <span class="lbl"> <?=tt('Показывать для родителей')?></span>
        <?=CHtml::hiddenField('settings[74]', PortalSettings::model()->findByPk(74)->ps2)?>
    </div>

    <div class="form-actions">
        <button type="submit" class="btn btn-info btn-small">
            <i class="icon-ok bigger-110"></i>
            <?=tt('Сохранить')?>
        </button>
    </div>

<?php $this->endWidget();?>