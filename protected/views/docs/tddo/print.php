<?php
/**
 *
 * @var DocsController $this
 * @var \Tddo $model
 */
$this->layout = 'print';

echo '<button class="confirm-print" onclick="window.print()">'.tt('Распечатать').'</button>';

echo '<h2 style="text-align:center">'.Ddo::model()->findByPk($docType)->getAttribute('ddo2').'</h2>';

$provider = $model->getDocsFor($docType);

$labels = $model->attributeLabels();

$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'docs-list',
    'dataProvider' => $provider,
    'type' => '',
    'template' => '{items}',
    'htmlOptions' => array(
        'class' => 'span12',
        'style' => ''
    ),
    'rowHtmlOptionsExpression' => 'array("data-id" => $data->tddo1)',
    'columns' => array(
        array(
            'name' => $labels['tddo7'],
            'value' => '$data->tddo7',
            'visible' => $docType == 1,
            'headerHtmlOptions' => array('style' => 'width:10%'),
            'cssClassExpression' => '$data->isOnControl() ? "isOnControl" : ""',
        ),
        array(
            'name' => $labels['tddo3'],
            'value' => '$data->tddo3',
            'visible' => $docType != 1,
            'headerHtmlOptions' => array('style' => 'width:5%'),
        ),
        array(
            'name' => $labels['tddo4'],
            'value' => 'SH::formatDate("Y-m-d H:i:s", "d.m.Y", $data->tddo4)',
            'headerHtmlOptions' => array('style' => 'width:5%'),
            'cssClassExpression' => '$data->hasAttachedFiles() ? "hasAttachesFiles" : ""',
        ),
        array(
            'name' => $labels['tddo8'],
            'value' => '$data->tddo8',
            'visible' => $docType == 1,
            'headerHtmlOptions' => array('style' => 'width:10%'),
        ),
        array(
            'name' => $labels['tddo9'],
            'value' => 'SH::formatDate("Y-m-d H:i:s", "d.m.Y", $data->tddo9)',
            'visible' => $docType == 1,
            'headerHtmlOptions' => array('style' => 'width:5%'),
        ),
        array(
            'name' => $labels['tddo5'],
            'header' => Tddo::getTddo5Header($docType),
            'value' => '$data->tddo5',
            'headerHtmlOptions' => array('style' => 'width:25%'),
        ),
        array(
            'name' => $labels['tddo6'],
            'value' => '$data->tddo6',
            'headerHtmlOptions' => array('style' => 'width:25%'),
        ),
        array(
            'name' => 'executor',
            'value' => '$data->getExecutorNames()',
            'visible' => Tddo::showExecutorFor($docType),
            'type' => 'raw',
        ),
        array(
            'name' => $labels['tddo10'],
            'value' => 'CHtml::checkBox("", $data->tddo10 == 2, array("disabled" => "disabled"))',
            'visible' => $docType >= 5,
            'type' => 'raw',
        ),
    ),
));
