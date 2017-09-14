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

$this->pageHeader=tt('Антиплагиат');
$this->breadcrumbs=array(
    tt('Другое'),
);

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

$warning = tt('Уважаемые студенты!');
$text = tt('«Антиплагиат» указывает лишь на факт заимствования, не оценивая правомерность заимствования. Оценка правомерности заимствований и, соответственно, реального объёма неправомерных заимствований находится к компетенции научного руководителя обучающегося. Нормативов допустимого объёма заимствований в проверяемых работах не установлено.');

echo <<<HTML
    <div class="alert alert-block">
        <h3>{$warning}</h3>
        {$text}
    </div>
HTML;

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