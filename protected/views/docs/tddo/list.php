<?php
/**
 *
 * @var DocsController $this
 */

$this->pageHeader=tt('Документооборот');
$this->breadcrumbs=array(
    tt('Док.-оборот'),
);
Yii::app()->clientScript->registerPackage('autosize');
Yii::app()->clientScript->registerPackage('jquery.ui');
Yii::app()->clientScript->registerPackage('chosen');

Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/docs/farm.js', CClientScript::POS_HEAD);

$confirmDeleteMsg = tt('Вы уверены, что хотите удалить документ?');
Yii::app()->clientScript->registerScript('variables', <<<JS
   tt.confirmDeleteMsg  = '{$confirmDeleteMsg}';
JS
    ,CClientScript::POS_READY);

?>
<form class="form-inline">
    <?php
        $docTypes = CHtml::listData(Ddo::model()->findAll(), 'ddo1', 'ddo2');
        echo CHtml::dropDownList('docType', $docType, $docTypes, array('empty' => ''));
    ?>
</form>

<div class="row-fluid" >
    <?php
    if (! empty($docType)) {
        $provider = Tddo::model()->getDocsFor($docType);

        $addUrl = Yii::app()->createUrl('docs/tddoCreate', array('docType' => $docType));

        $pager = <<<HTML
    <div>
        <button class="add-doc btn btn-pink btn-small" data-href="{$addUrl}">
            <i class="icon-share-alt bigger-200"></i>%s
        </button>

        <div class="pull-right">{pager}</div>
    </div>
HTML;

        $this->widget('bootstrap.widgets.TbGridView', array(
            'id' => 'docs-list',
            'dataProvider' => $provider,
            'type' => 'striped bordered',
            'template' => '{items} '.sprintf($pager, tt('Добавить')),
            'htmlOptions' => array(
                'class' => 'span12',
                'style' => ''
            ),
            'rowHtmlOptionsExpression' => 'array("data-id" => $data->tddo1)',
            'columns' => array(
                array(
                    'name' => 'tddo7',
                    'value' => '$data->tddo7',
                    'visible' => $docType == 1,
                    'headerHtmlOptions' => array('style' => 'width:10%')
                ),
                array(
                    'name' => 'tddo3',
                    'value' => '$data->tddo3',
                    'visible' => $docType != 1,
                    'headerHtmlOptions' => array('style' => 'width:5%')
                ),
                array(
                    'name' => 'tddo4',
                    'value' => 'SH::formatDate("Y-m-d H:i:s", "d.m.Y", $data->tddo4)',
                    'headerHtmlOptions' => array('style' => 'width:5%')
                ),
                array(
                    'name' => 'tddo8',
                    'value' => '$data->tddo8',
                    'visible' => $docType == 1,
                    'headerHtmlOptions' => array('style' => 'width:10%')
                ),
                array(
                    'name' => 'tddo9',
                    'value' => 'SH::formatDate("Y-m-d H:i:s", "d.m.Y", $data->tddo9)',
                    'visible' => $docType == 1,
                    'headerHtmlOptions' => array('style' => 'width:5%')
                ),
                array(
                    'name' => 'tddo5',
                    'header' => Tddo::getTddo5Header($docType),
                    'value' => '$data->tddo5',
                    'headerHtmlOptions' => array('style' => 'width:30%')
                ),
                array(
                    'name' => 'tddo6',
                    'value' => '$data->tddo6',
                    'headerHtmlOptions' => array('style' => 'width:25%')
                ),
                array(
                    'name' => 'executor',
                    'value' => '$data->getExecutorNames()',
                    'visible' => Tddo::showExecutorFor($docType),
                    'type' => 'raw',
                    'cssClassExpression' => '($data->executorType == Tddo::ONLY_TEACHERS
                                                ? "only-teachers"
                                                : ($data->executorType == Tddo::ONLY_INDEXES
                                                    ? "only-indexes"
                                                    : ($data->executorType == Tddo::ONLY_CHAIRS
                                                        ? "only-chairs"
                                                        : "")));',
                ),
                array(
                    'name' => 'tddo10',
                    'value' => 'CHtml::checkBox("", $data->tddo10 == 2, array("disabled" => "disabled"))',
                    'visible' => $docType >= 5,
                    'type' => 'raw',
                ),
                array(
                    'class'=>'CButtonColumn',
                    'template'=>'{delete}',
                    'buttons'=>array(
                        'delete'=>array(
                            'url'=>'Yii::app()->controller->createAbsoluteUrl("docs/deleteTddo", array("tddo1" => $data->tddo1))',
                            'click' => 'function(){}',
                            'options' => array('class' => 'delete btn btn-mini btn-danger'),
                            'imageUrl' => false,
                            'label' => '<i class="icon-trash bigger-120"></i>'
                        ),
                    ),
                ),
            ),
        ));
    }
    ?>
</div>