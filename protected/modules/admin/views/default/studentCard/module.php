<?php
/**
 * Created by PhpStorm.
 * User: Neff
 * Date: 25.12.2015
 * Time: 10:11
 */

$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'ps-student-card-module',
    'htmlOptions' => array('class' => 'form-horizontal form-settings'),
    'action' => '#'
));

$options = array(
    ' '.tt('ПМК'),
    ' '.tt('Упрощеная'),
);

$htmlOptions = array(
    'class'=>'ace',
    'labelOptions' => array(
        'class' => 'lbl'
    )
);

?>
    <div class="control-group">
        <span class="lbl"> <?=tt('Тип:')?></span><br>
        <?=CHtml::radioButtonList('settings[76]', PortalSettings::model()->findByPk(76)->ps2, $options, $htmlOptions)?>
    </div>

    <div class="form-actions">
        <button type="submit" class="btn btn-info btn-small">
            <i class="icon-ok bigger-110"></i>
            <?=tt('Сохранить')?>
        </button>
    </div>

<?php $this->endWidget();?>