<?php
/**
 *
 * @var OtherController $this
 */

Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/other/antiPlagiarism.js', CClientScript::POS_HEAD);

$this->pageHeader=tt('Антиплагиат');
$this->breadcrumbs=array(
    tt('Другое'),
);

?>


    <div class="span4">
        <div class="widget-box">
            <div class="widget-header">
                <h4><?=tt('Файл')?></h4>
            </div>

            <div class="widget-body">
                <div class="widget-main no-padding">
                    <?php
                        $form=$this->beginWidget('CActiveForm', array(
                            'id'=>'attach-file-form',
                            'htmlOptions' => array(
                                'enctype' => 'multipart/form-data',
                            )
                        ));
                    ?>

                        <fieldset>
                            <?= CHtml::fileField('files[]', '', array('id' => 'id-input-file-3', 'multiple' => 'true')) ?>
                        </fieldset>

                        <div class="form-actions center">
                            <button class="btn btn-small btn-success">
                                <?=tt('Отправить')?>
                                <i class="icon-arrow-right icon-on-right bigger-110"></i>
                            </button>
                        </div>
                    <?php $this->endWidget(); ?>
                </div>
            </div>
        </div>
    </div>
