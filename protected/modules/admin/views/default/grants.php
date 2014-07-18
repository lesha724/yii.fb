<?php
/**
 *
 * @var DefaultController $this
 * @var P $model
 *
 */

Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/admin/teachers.js', CClientScript::POS_HEAD);

$this->pageHeader=tt('Права доступа');
$this->breadcrumbs=array(
    tt('Преподаватели') => array('/admin/default/teachers'),
    tt('Права доступа'),
);
?>

<?php
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'grants',
        'type' => 'horizontal',
        'action' => ''//$this->createUrl('/admin/prospect/scheduleProspect')
    ));
?>
    <div class="control-group">
        <?=$form->label($model, 'grants3', array('class' => 'control-label'))?>
        <div class="controls">
            <?php
                $options = array(' '.tt('Дисциплины преподавателя'), ' '.tt('Дисциплины кафедры'));
                echo $form->radioButtonList($model, 'grants3', $options,
                    array(
                        'labelOptions' => array('class' => 'lbl'),
                        //'template' => '<label>{input}{label}</label>',
                        'class' => 'ace'
                    )
                )
            ?>
        </div>
    </div>

    <div class="control-group">
        <?=$form->label($model, 'grants5', array('class' => 'control-label'))?>
        <div class="controls">
            <label>
                <?php
                    echo CHtml::checkBox('Grants[grants5]', $model->grants5,
                        array(
                            'class' => 'ace ace-switch'
                        )
                    )
                ?>
                <span class="lbl"></span>
            </label>
        </div>
    </div>

    <div class="form-actions">
        <button type="submit" class="btn btn-info">
            <i class="icon-ok bigger-110"></i>
            <?=tt('Сохранить')?>
        </button>
    </div>

<?php $this->endWidget();