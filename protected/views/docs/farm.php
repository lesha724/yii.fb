<?php
/**
 *
 * @var DocsController $this
 */

$this->pageHeader=tt('Документооборот');
$this->breadcrumbs=array(
    tt('Док.-оборот'),
);
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/docs/farm.js', CClientScript::POS_HEAD);

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
    $this->widget('bootstrap.widgets.TbGridView', array(
        'id' => 'docs-list',
        'dataProvider' => $provider,
        'type' => 'striped bordered',
        'template' => '{items} <div class="pull-right">{pager}</div>',
        'htmlOptions' => array(
            'class' => 'span12',
            'style' => ''
        ),
        'columns' => array(
            array(
                'name' => '№',
                'value' => '$data->tddo1',
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