<?php
    Yii::app()->clientScript->registerPackage('dataTables');
    Yii::app()->clientScript->registerPackage('daterangepicker');
    Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/progress/_modules.js', CClientScript::POS_HEAD);

    $moduleError   = tt('Модуль не сохранен!');
    $moduleSuccess = tt('Модуль сохранен!');
    $moduleDeleted = tt('Модуль удален!');
    $confirmDeleteMsg = tt('Вы уверены, что хотите удалить модуль?');

    $vvmp  = Vvmp::model()->loadBillBy($nr1, $students);
    $vvmp1 = $vvmp->vvmp1;

    Yii::app()->clientScript->registerScript('messages', <<<JS
            tt.moduleError      = '{$moduleError}';
            tt.moduleSuccess    = '{$moduleSuccess}'
            tt.moduleDeleted    = '{$moduleDeleted}'
            tt.confirmDeleteMsg = '{$confirmDeleteMsg}';
            vvmp1 = '{$vvmp1}';
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
                'class' => 'span4',
                'style' => 'margin-left:0'
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

<div class="row-fluid span4"  style="margin-left:0">
    <form class="form-inline" action="<?=Yii::app()->createAbsoluteUrl('progress/insertMejModule')?>">
        <input type="hidden" name="mej4">
        <input type="hidden" name="mej5">
        <input class="span8" type="text" name="date-range-picker" id="id-date-range-picker-1" placeholder="<?=tt('Новый модуль')?>"/>
        <button id="addNewModule" class="btn btn-info btn-small" type="button">
            <i class="icon-plus bigger-110"></i>
            <?=tt('Добавить')?>
        </button>
    </form>
</div>



