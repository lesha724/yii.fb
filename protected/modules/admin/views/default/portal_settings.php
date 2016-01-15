<?php
$this->pageHeader=tt('Настройки портала');
$this->breadcrumbs=array(
tt('Настройки портала'),
);
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/admin/journal.js');
Yii::app()->clientScript->registerPackage('datepicker');
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/admin/psettings.js');
?>
<div class="span4">
    <div class="widget-box">
        <div class="widget-header">
            <h4><?=tt('Настройки закрытия портала')?></h4>
            <span class="widget-toolbar">
                <a data-action="collapse" href="#">
                    <i class="icon-chevron-up"></i>
                </a>
            </span>
        </div>
        <div class="widget-body">
            <div class="widget-main">
                <?php
                $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                    'id'=>'ps-appearance',
                    'htmlOptions' => array('class' => 'form-horizontal'),
                    'action' => '#'
                ));
                $checkboxStyle = array('class' => 'ace ace-switch ace-switch-4');
                $htmlOptions2 = array(
                    'class'=>'ace',
                );
                ?>

                <div class="control-group">
                    <span class="lbl"> <?=tt('Название ВУЗа')?>:</span>
                    <?=CHtml::textField('settings[45]', PortalSettings::model()->findByPk(45)->ps2)?>
                </div>

                <div class="control-group">
                    <span class="lbl"> <?=tt('Название министерсва')?>:</span>
                    <?=CHtml::textField('settings[46]', PortalSettings::model()->findByPk(46)->ps2)?>
                </div>

                <div class="control-group">
                    <?=CHtml::checkBox('', PortalSettings::model()->findByPk(38)->ps2, $checkboxStyle)?>
                    <span class="lbl"> <?=tt('Закрыть портал на тех.Обслуживание')?></span>
                    <?=CHtml::hiddenField('settings[38]', PortalSettings::model()->findByPk(38)->ps2)?>
                </div>

                <div class="control-group">
                    <span class="lbl"> <?=tt('Текст тех. обслуживания')?>:</span>
                    <?=CHtml::textField('settings[39]', PortalSettings::model()->findByPk(39)->ps2)?>
                </div>

                <div class="control-group">
                    <span class="lbl"> <?=tt('Текст закрытия журнала для кафедр')?>:</span>
                    <?=CHtml::textField('settings[43]', PortalSettings::model()->findByPk(43)->ps2)?>
                </div>

                <div class="control-group">
                    <span class="lbl"> <?=tt('Начало Весеннего семестра')?>:</span>
                    <?=CHtml::textField('settings[53]', PortalSettings::model()->findByPk(53)->ps2,array('class' => 'sem-start datepicker'))?>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-info btn-small">
                        <i class="icon-ok bigger-110"></i>
                        <?=tt('Сохранить')?>
                    </button>
                </div>

                <?php $this->endWidget();?>
            </div>
        </div>
    </div>
</div>
