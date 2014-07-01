<?php
/**
 *
 * @var DefaultController $this
 */
$this->pageHeader=tt('Настройки сервиса Абитуриент');
$this->breadcrumbs=array(
    tt('Админ. панель'),
);

Yii::app()->clientScript->registerPackage('datepicker');
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/admin/entrance.js');
?>

<div class="span4">
    <div class="widget-box">
        <div class="widget-header">
            <h4><?=tt('Абитуриент')?></h4>
            <span class="widget-toolbar">
                <a data-action="collapse" href="#">
                    <i class="icon-chevron-up"></i>
                </a>
            </span>
        </div>
        <div class="widget-body">
            <div class="widget-main">
                <?php
                    $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                        'id'=>'ps-extra-columns',
                        'htmlOptions' => array('class' => 'form-horizontal'),
                        'action' => '#'
                    ));

                    $htmlOptions = array(
                        'class'=>'ace',
                    );

                    $pattern = <<<HTML
<div class="control-group">
    <label class="span4">%s</label>
    <div class="span8">
        <span>
           %s
        </span>
    </div>
</div>
HTML;

                    $inputStyle = array('placeholder' => tt('Дата'), 'class' => 'span12');
                    $input = CHtml::textField('settings[23]', PortalSettings::model()->findByPk(23)->ps2, $inputStyle);
                    echo sprintf($pattern, 'Дата начала приемной комисси', $input);

                    $inputStyle = array('placeholder' => tt('Дата'), 'class' => 'span12');
                    $input = CHtml::textField('settings[24]', PortalSettings::model()->findByPk(24)->ps2, $inputStyle);
                    echo sprintf($pattern, 'Дата окончания приемной комисси', $input);

                ?>

                <div class="control-group">
                    <?=CHtml::checkBox('', PortalSettings::model()->findByPk(25)->ps2, $htmlOptions);?>
                    <span class="lbl"> <?=tt('Отображать колонки: Заключили, Оплатили, Не оплатили')?></span>
                    <?=CHtml::hiddenField('settings[25]', PortalSettings::model()->findByPk(25)->ps2)?>
                </div>

                <div class="control-group">
                    <?=CHtml::checkBox('', PortalSettings::model()->findByPk(26)->ps2, $htmlOptions);?>
                    <span class="lbl"> <?=tt('Отображать колонку - № личного дела')?></span>
                    <?=CHtml::hiddenField('settings[26]', PortalSettings::model()->findByPk(26)->ps2)?>
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
