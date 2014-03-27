<?php
    Yii::app()->clientScript->registerPackage('dataTables');
    Yii::app()->clientScript->registerPackage('daterangepicker');
    Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/progress/_modules.js', CClientScript::POS_HEAD);

$moduleError   = tt('Модуль не сохранен!');
$moduleSuccess = tt('Модуль сохранен!');
$confirmDeleteMsg = tt('Вы уверены, что хотите удалить модуль?');

Yii::app()->clientScript->registerScript('messages', <<<JS
        tt.moduleError      = '{$moduleError}';
        tt.moduleSuccess    = '{$moduleSuccess}'
        tt.confirmDeleteMsg = '{$confirmDeleteMsg}';
JS
    ,CClientScript::POS_READY);


?>



<div class="row-fluid" >
    <div class="hr hr-18 dotted hr-double"></div>

    <h3 class="header smaller lighter blue"><?=tt('Модули')?></h3>
    <?php
        $provider = Mej::model()->getModulesFor($nr1);
        $this->widget('bootstrap.widgets.TbGridView', array(
            'id' => 'modules-list',
            'dataProvider' => $provider,
            'type' => 'striped bordered',
            'template' => '{items}',
            'htmlOptions' => array(
                'class' => 'span4'
            ),
            'columns' => array(
                array(
                    'name' => '№',
                    'value' => '++$row',
                ),
                array(
                    'name' => tt('Дата начала'),
                    'value' => 'SH::formatDate("Y-m-d H:i:s", "d.m.Y", $data->mej4)',
                ),
                array(
                    'name' => tt('Дата окончания'),
                    'value' => 'SH::formatDate("Y-m-d H:i:s", "d.m.Y", $data->mej5)',
                ),
                array(
                    'class'=>'CButtonColumn',
                    'template'=>'{delete}',
                    'buttons'=>array(
                        'delete'=>array(
                            'url'=>'Yii::app()->controller->createAbsoluteUrl("progress/deleteMejModule", array("mej1" => $data->mej1))',
                            'click' => 'function(){}',
                            'options' => array('class' => 'delete btn btn-mini btn-danger'),
                            'imageUrl' => false,
                            'label' => '<i class="icon-trash bigger-120"></i>'
                        ),

                    ),
                ),
            ),
        ));
?>
</div>

<div class="hr hr-18 dotted hr-double"></div>

<div class="row-fluid">
    <div class="widget-box span3">
        <div class="widget-header">
            <h4><?=tt('Новый модуль')?></h4>
        </div>

        <div class="widget-body">
            <div class="widget-main">
                <form class="form-inline" action="<?=Yii::app()->createAbsoluteUrl('progress/insertMejModule')?>">
                    <input type="hidden" name="mej4">
                    <input type="hidden" name="mej5">
                    <input class="span8" type="text" name="date-range-picker" id="id-date-range-picker-1" />
                    <button id="addNewModule" class="btn btn-info btn-small" type="button">
                        <i class="icon-plus bigger-110"></i>
                        <?=tt('Добавить')?>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>



