<?php
    Yii::app()->clientScript->registerPackage('dataTables');
    Yii::app()->clientScript->registerPackage('daterangepicker');
    Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/progress/_modules.js', CClientScript::POS_HEAD);

    $modules = Mej::model()->findAllByAttributes(array('mej3' => $nr1));
?>



<div class="row-fluid">
    <div class="hr hr-18 dotted hr-double"></div>

    <h3 class="header smaller lighter blue"><?=tt('Модули')?></h3>

    <table id="modules" class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th><?=tt('№')?></th>
                <th><?=tt('Дата начала')?></th>
                <th><?=tt('Дата окончания')?></th>
            </tr>
        </thead>
        <tbody>
           <?php
               foreach ($modules as $module) {
                   $dateStart = SH::formatDate('Y-m-d H:i:s', 'd.m.Y', $module['mej4']);
                   $dateEnd   = SH::formatDate('Y-m-d H:i:s', 'd.m.Y', $module['mej5']);
                   echo <<<HTML
                    <tr>
                        <td>{$module['mej2']}</td>
                        <td>{$dateStart}</td>
                        <td>{$dateEnd}</td>
                    </tr>
HTML;
               }
           ?>
        </tbody>
    </table>
</div>

<div class="hr hr-18 dotted hr-double"></div>

<div class="row-fluid">
    <div class="widget-box span3">
        <div class="widget-header">
            <h4><?=tt('Новый модуль')?></h4>
        </div>

        <div class="widget-body">
            <div class="widget-main">
                <form class="form-inline">
                    <input class="span8" type="text" name="date-range-picker" id="id-date-range-picker-1" />
                    <button class="btn btn-info btn-small" onclick="return false;">
                        <i class="icon-plus bigger-110"></i>
                        <?=tt('Добавить')?>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>



