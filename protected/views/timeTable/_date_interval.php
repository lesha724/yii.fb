<?php
    Yii::app()->clientScript->registerPackage('daterangepicker');
    Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/timetable/_date_interval.js', CClientScript::POS_HEAD);

    $startDate = $date1;
    $endDate   = $date2;
    Yii::app()->clientScript->registerScript('date-range', <<<JS
        startDate = "{$startDate}";
        endDate   = "{$endDate}";
JS
    , CClientScript::POS_HEAD);

?>

<div style="margin-top:1%">
    <div class="control-group span2">
        <div class="row-fluid input-prepend">
            <span class="add-on">
                <i class="icon-calendar"></i>
            </span>
            <input class="span10" type="text" name="date-range-picker" id="id-date-range-picker-1" value="<?=$date1.' - '.$date2?>"/>
        </div>
    </div>

    <button id="addNewModule" class="btn btn-info btn-small" type="submit">
        <i class="icon-plus bigger-110"></i>
        <?=tt('Изменить')?>
    </button>
</div>