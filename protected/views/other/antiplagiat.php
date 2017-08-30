<?php
/**
 * Created by PhpStorm.
 * User: Neff
 * Date: 30.08.2017
 * Time: 11:08
 */

/**
 * @var OtherController $this
 * @var $student St
 * @var $nkrsList mixed
 */

$course = tt('Курс');
$chair = tt('Кафедра');
$themeRus = tt('Тема на русском');
$curator = tt('Научный руководитель');

$rows = '';

foreach ($nkrsList as $item){
    $curatorName = SH::getShortName($item['p3'], $item['p4'],$item['p5']);
    $rows.=<<<HTML
            <tr>
                <td>{$item['sem4']}</td>
                <td>{$item['k2']}</td>
                <td>{$item['spkr2']}</td>
                <td>{$curatorName}</td>
            </tr>
HTML;

}

$table = <<<HTML
        <table class="table table-bordered table-hover table-condensed table-striped">
            <thead>
                <tr>
                    <th>{$course}</th>
                    <th>{$chair}</th>
                    <th>{$themeRus}</th>
                    <th>{$curator}</th>
                </tr>
            </thead>
            <tbody>
                {$rows}
            </tbody>
        </table> 
HTML;

echo $table;

?>

<div class="span4">
        <div class="widget-box">
            <div class="widget-header">
                <h4><?=tt('Антиплагиат')?></h4>
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
                        <?= CHtml::fileField('document', '') ?>
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