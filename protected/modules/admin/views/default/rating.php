<?php
$this->pageHeader=tt('Рейтинг');
$this->breadcrumbs=array(
tt('Админ. панель'),
);
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/admin/journal.js');
?>

<div class="span6">
    <div class="widget-box">
        <div class="widget-header">
            <h4><?=tt('Настройки рейтинга')?></h4>
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
                    'htmlOptions' => array('class' => 'form-horizontal  form-settings'),
                    'action' => '#'
                ));

                $options = array(
                    ' '.tt('5-бальная'),
                    ' '.tt('многобальная'),
                );
                $htmlOptions = array(
                    'class'=>'ace',
                    'labelOptions' => array(
                        'class' => 'lbl'
                    )
                );
                ?>

                <div class="control-group">
                    <?=CHtml::radioButtonList('settings[81]', PortalSettings::model()->findByPk(81)->ps2, $options, $htmlOptions)?>
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

