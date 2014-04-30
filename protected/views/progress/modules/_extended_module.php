<?php

function generateTh2($moduleInfo, $i, $isClosed = false)
{
    $min = $moduleInfo['min_mod_'.$i];
    $max = $moduleInfo['max_mod_'.$i];

    $field1 = 8+2*$i;
    $field2 = 9+2*$i;

    $pattern = <<<HTML
<th style="text-align:center"><input value="{$min}" maxlength="3" placeholder="min" data-name="vvmp{$field1}" %s></th>
<th style="text-align:center"><input value="{$max}" maxlength="3" placeholder="max" data-name="vvmp{$field2}" %s></th>
HTML;

    $disabled = $isClosed
        ? 'disabled="disabled"'
        : '';

    return sprintf($pattern, $disabled, $disabled);
}

function generateTr($st, $moduleInfo, $module)
{
    $marks = Vmp::model()->getMarksForStudent($st['st1'], $moduleInfo['vvmp1']);

    $pattern = <<<HTML
        <tr data-st1="{$st['st1']}" data-module="{$module}">
            <td>%s</td>
            <td><input data-name='vmp5' value="%s" maxlength="3"></td>
            <td><input data-name='vmp6' value="%s" maxlength="3"></td>
            <td><input data-name='vmp7' value="%s" maxlength="3"></td>
            <td colspan="2" class="module_total" >%s</td>
        </tr>
HTML;

    $name = SH::getShortName($st['st2'], $st['st3'], $st['st4']);

    $vmp5 = isset($marks[$module]) && $marks[$module]['vmp5'] != 0
                ? round($marks[$module]['vmp5'], 1)
                : '';
    $vmp6 = isset($marks[$module]) && $marks[$module]['vmp6'] != 0
                ? round($marks[$module]['vmp6'], 1)
                : '';
    $vmp7 = isset($marks[$module]) && $marks[$module]['vmp7'] != 0
                ? round($marks[$module]['vmp7'], 1)
                : '';
    $vmp4 = isset($marks[$module]) && $marks[$module]['vmp4'] != 0
                ? round($marks[$module]['vmp4'], 1)
                : '';

    return sprintf($pattern, $name, $vmp5, $vmp6, $vmp7, $vmp4);
}

$url = Yii::app()->createUrl('/progress/insertVmpMark');
$minMaxUrl = Yii::app()->createUrl('/progress/updateVvmp');
?>

<div tabindex="-1" class="modal hide fade" id="modal-table" style="display: none;" aria-hidden="true">
    <div class="modal-header no-padding">
        <div class="table-header">
            <button data-dismiss="modal" class="close" type="button">×</button>
            <span><?=tt('Расширенные оценки')?> <?=$moduleInfo['name_modul_'.$module_num]?></span>
        </div>
    </div>

    <div class="modal-body no-padding">
        <div class="row-fluid">
            <table class="expanded-module table table-striped table-bordered table-hover no-margin-bottom no-border-top">
                <thead data-url="<?=$minMaxUrl?>">
                    <tr>
                        <th rowspan="2"><?=tt('ФИО')?></th>
                        <th rowspan="2" style="width:15%"><?=PortalSettings::model()->findByPk(17)->ps2?></th>
                        <th rowspan="2" style="width:15%"><?=PortalSettings::model()->findByPk(18)->ps2?></th>
                        <th rowspan="2" style="width:15%"><?=PortalSettings::model()->findByPk(19)->ps2?></th>
                        <th colspan="2" style="width:15%"><?=$moduleInfo['name_modul_'.$module_num]?></th>
                    </tr>
                    <tr class="min-max">
                        <?=generateTh2($moduleInfo, $module_num);?>
                    </tr>
                </thead>

                <tbody data-url="<?=$url?>">
                    <?php
                        $tr = '';
                        foreach ($students as $student) {
                            $tr .= generateTr($student, $moduleInfo, $module_num);
                        }
                        echo $tr;
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal-footer">
        <button data-dismiss="modal" class="btn btn-small btn-danger pull-left">
            <i class="icon-remove"></i>
            Close
        </button>
    </div>
</div>
