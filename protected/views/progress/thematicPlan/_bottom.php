<?php
/**
 *
 * @var ProgressController $this
 * @var $model FilterForm
 */

//$urlEdit   = Yii::app()->controller->createAbsoluteUrl("progress/renderUstemTheme", array("us1" => 390219, 'd1' => $model->discipline));
?>
<!--<a href="<?php //echo $urlEdit?>" class="edit-theme btn btn-mini btn-info">
    <i class="icon-edit bigger-120"></i>
</a>-->

<div class="row-fluid" >

    <h3 class="header smaller lighter blue"><?=tt('Темы занятий')?></h3>

    <table id="themes" class="table table-striped table-bordered table-hover">
        <thead>
        <tr>
            <th><?=tt('№')?></th>
            <th><?=tt('№ темы')?></th>
            <th><?=tt('№ занятия')?></th>
            <th><?=tt('Длительность')?></th>
            <th><?=tt('Тема')?></th>
            <th><?=tt('Тип')?></th>
            <th><?=tt('Преподаватель')?></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
            <?php
                $themes = Ustem::model()->getThemesBy($model);

                $html = '';
                $i = 1;
                foreach ($themes as $theme) {

                    $tip = $theme['submod'] == 0 ? tt('Занятие') : tt('Субмодуль');
                    $urlDelete = Yii::app()->controller->createAbsoluteUrl("progress/deleteUstemTheme", array("ustem1" => $theme['ustem1']));
                    $urlEdit   = Yii::app()->controller->createAbsoluteUrl("progress/renderUstemTheme", array("us1" => $model->semester, 'd1' => $model->discipline));

                    $html .= <<<HTML
                        <tr>
                            <td>$i</td>
                            <td>$theme[nom_temi]</td>
                            <td>$theme[nom_zan]</td>
                            <td>$theme[dlitel]</td>
                            <td>$theme[tema]</td>
                            <td>$tip</td>
                            <td>$theme[fio]</td>
                            <td>
                                <a href="$urlEdit" class="edit-theme btn btn-mini btn-info">
                                    <i class="icon-edit bigger-120"></i>
                                </a>
                                <a href="$urlDelete" class="delete-theme btn btn-mini btn-danger">
                                    <i class="icon-trash bigger-120"></i>
                                </a>
                            </td>
                        </tr>
HTML;
                    $i++;
                }
                echo $html;
            ?>
        </tbody>
    </table>
<?php

/*    $this->widget('bootstrap.widgets.TbGridView', array(
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
    ));*/
?>
</div>