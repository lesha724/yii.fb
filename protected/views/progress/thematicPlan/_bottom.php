<?php
/**
 *
 * @var ProgressController $this
 * @var $model FilterForm
 */

?>
<div class="row-fluid" >

    <h3 class="header smaller lighter blue"><?=tt('Темы занятий')?></h3>
<?php

    // TODO pd6 где то учесть
    $provider = Nr::model()->searchThemesBy($model->semester);

    $this->widget('bootstrap.widgets.TbGridView', array(
        'id' => 'themes-list',
        'dataProvider' => $provider,
        'type' => 'striped bordered',
        'template' => '{items}{pager}',
        'htmlOptions' => array(
            'class' => 'span12',
            'style' => 'margin-left:0'
        ),
        'columns' => array(
            'nr31',
            'nr32',
            'nr33',
            array(
                'name' => 'nr34',
                'value' => '$data->nr34 == 0
                                ? tt("Занятие")
                                : tt("Субмодуль")',
            ),
            array(
                'name' => 'nr6',
                'value' => '$data->nr6 != 0
                                ? P::model()->getTeacherNameBy($data->nr6)
                                : ""',
            ),
            array(
                'class'=>'CButtonColumn',
                'template'=>'{edit}{delete}',
                'buttons'=>array(
                    'edit'=>array(
                        'url'=>'Yii::app()->controller->createAbsoluteUrl("progress/renderNrTheme", array("nr1" => $data->nr1))',
                        'click' => 'function(){}',
                        'options' => array('class' => 'edit-theme btn btn-mini btn-info'),
                        'imageUrl' => false,
                        'label' => '<i class="icon-edit bigger-120"></i>'
                    ),
                    'delete'=>array(
                        'url'=>'Yii::app()->controller->createAbsoluteUrl("progress/deleteNrTheme", array("nr1" => $data->nr1))',
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