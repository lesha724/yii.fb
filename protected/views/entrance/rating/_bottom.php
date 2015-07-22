<style>
    .table-striped tbody > tr:nth-child(2n+1) > td, .table-striped tbody > tr:nth-child(2n+1) > th {
        background-color: transparent;
    }
</style>
<?php
/**
 *
 * @var EntranceController $this
 * @var $model FilterForm
 */

// колонка - № личного дела
global $showColumn;
$showColumn = PortalSettings::model()->findByPk(26)->ps2;
$showColumn30 = PortalSettings::model()->findByPk(30)->ps2;
$showColumn31 = PortalSettings::model()->findByPk(31)->ps2;
$showColumn32 = PortalSettings::model()->findByPk(32)->ps2;
$colspan = 7;
if ($showColumn)
    $colspan++;
if ($showColumn30)
    $colspan+=2;
if ($showColumn31)
    $colspan++;
if ($showColumn32)
    $colspan++;

function getDocumentTypeFor($st, $model)
{
    // копия или оригинал документов
    $tmp_1 = $tmp_2 = '&nbsp;';

    $t = 'abd33';

    //if (SH::is(U_BSAA))
    //    $t = 'abd29';
    //else
    if(SH::is(U_OSEU) && $model->course != 5)
        $t = 'ABD29';


    $st["$t"] == 1 ? $tmp_2 = "+" : $tmp_1 = "+";

    return array($tmp_1, $tmp_2);
}

function generateTr($i, $st, $model)
{
    global $showColumn;

    list($td1, $td2) = getDocumentTypeFor($st, $model);

    $mark = round($st['abd20'], 3);

    $bgColor = '';
    //if ($st['color'])
    if ($td2=="+")
        $bgColor = 'background-color:'.$st['color'].' !important';

    $tr = <<<HTML
            <tr style="$bgColor">
                <td>$i</td>
HTML;
    if ($showColumn)
    $tr .= <<<HTML
                <td>$st[abd9]</td>
HTML;
    $tr .= <<<HTML
                <td>$st[ab2]</td>
                <td>$st[ab3]</td>
                <td>$st[ab4]</td>
                <td>$mark</td>
HTML;
    if ($showColumn30)
    $tr .= <<<HTML
                <td>$st[ind1_3]</td>
                <td>$st[ind4]</td>
HTML;
    $tr .= <<<HTML
                <td>{$td1}</td>
                <td>{$td2}</td>
HTML;
    if ($showColumn31)
    $tr .= <<<HTML
                <td>$st[abd13]</td>
HTML;
    if ($showColumn32)
    $tr .= <<<HTML
                <td>$st[notice]</td>
HTML;
    $tr .= <<<HTML
            </tr>
HTML;

    return $tr;

}

function generateEmptyRow($colspan)
{
    $tr = '';
    for($i=1;$i<=$colspan;$i++)
        $tr .= '<td></td>';

    return $tr;
}

    $isBsaa  = SH::is(U_BSAA);
    $isOseu  = SH::is(U_OSEU);
    $isNulau = SH::is(U_NULAU);

    Yii::app()->clientScript->registerScript('chart', <<<JS

JS
    , CClientScript::POS_END);


$speciality = Spab::model()->findByPk($model->speciality);

$cnPlan = null;
if (! empty($model->cn1))
    $cnPlan = Spabk::model()->findByAttributes(array(
        'spabk1' => $speciality->spab1,
        'spabk2' => $model->cn1
    ));
?>

<div class="row-fluid" >

    <h3 class="header smaller lighter blue">
        <?=tt('Рейтинговый список')?>
        <small>
            <i class="icon-double-angle-right"></i>
            <?=$speciality->getAttribute($isBsaa?'spab3':'spab14');?>
        </small>
    </h3>

    <table id="rating" class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th rowspan="2" style="width:2%"><?=tt('№ п/п')?></th>
                <?php if ($showColumn) :?>
                    <th rowspan="2"><?=tt('№ личного дела')?></th>
                <?php endif; ?>
                <th rowspan="2"><?=tt('Фамилия')?></th>
                <th rowspan="2"><?=tt('Имя')?></th>
                <th rowspan="2"><?=tt('Отчество')?></th>
                <th rowspan="2" style="width:5%"><?=tt('Сумма баллов')?></th>
                <?php if ($showColumn30) :?>
                    <th colspan="2" style="width:14%"><?=tt('Учет инд. достижений')?></th>
                <?php endif; ?>
                <th colspan="2"><?=tt('Документы')?></th>
                <?php if ($showColumn31) :?>
                    <th rowspan="2"><?=tt('Приоритет')?></th>
                <?php endif; ?>
                <?php if ($showColumn32) :?>
                    <th rowspan="2"><?=tt('Примечание')?></th>
                <?php endif; ?>
            </tr>
            <tr>
                <?php if ($showColumn30) :?>
                    <th style="width:7%"><?=tt('П.1-3')?></th>
                    <th style="width:7%"><?=tt('П.4')?></th>
                 <?php endif; ?>
                <th style="width:5%"><?=tt('Копия')?></th>
                <th style="width:5%"><?=tt('Оригинал')?></th>
            </tr>
        </thead>
        <tbody>
        <?php
            $title  = $isBsaa ? tt("НА ФЕДЕРАЛЬНЫЙ БЮДЖЕТ") : tt("НА БЮДЖЕТНОЙ ОСНОВЕ");

            $count = 0;
            if (empty($model->cn1))
                $count = $speciality->getAttribute('spab11');
            else
                if (! empty($cnPlan)) $count = $cnPlan->getAttribute('spabk3');

            $title .= " (".$count.")";
            if ($count > 0) :
        ?>
        <tr>
            <td colspan="<?=$colspan?>" class="entrance-rating-title">
                <h4>
                    <?=$title;?>
                </h4>
            </td>
        </tr>

        <?php
            if (! empty($list_1)) :
        ?>
                <tr>
                    <td colspan='<?=$colspan?>'>
                        <?php
                            $spab17 = $speciality->getAttribute('spab17');
                            echo tt('ВНЕ КОНКУРСА').' ('.$spab17.')'
                        ?>
                    </td>
                </tr>
                <?php
                    $i = 1;
                    $html = '';
                    foreach ($list_1 as $st) {
                        $html .= generateTr($i, $st, $model);
                        $i++;
                    }
                    echo $html;
            endif;
            ?>

        <?php

            $showList2 = true;

            if ($isNulau) {
                //$showList2 = //in_array($model->speciality, array(/*здесь какие-то особые специальности*/)) &&
                             //Spabk::model()->checkIfCNExists($model->speciality);
            } else {
                //$showList2 = //Spabk::model()->checkIfCNExists($model->speciality);
            }


            if ($showList2) :

                $html = '';

                if ($model->cn1)
                    $cns = array(Cn::model()->findByPk($model->cn1));
                else
                    $cns = Cn::model()->getAllCn();

                foreach ($cns as $cn) {

                    $list = Ab::model()->getStudents($model, 0, 'abd66=0 AND abd6='.$cn->cn1);

                    $title = $cn->cn2.' ('.Spabk::model()->getValueOf('spabk3', $model->speciality, $cn->cn1).')';
                    $html .= <<<HTML
                        <tr><td colspan='{$colspan}' style='text-decoration:underline;'>{$title}</td></tr>
HTML;

                    $i = 1;
                    $inContest = $outOfContest = '';
                    foreach ($list as $st) {

                        $tr = generateTr($i, $st, $model);

                        if ($st['abd66'] == 0)
                            $inContest .= $tr;
                        else
                            $outOfContest .= $tr;

                        $i++;
                    }

                    if (! empty($outOfContest)) {
                        $title = tt('ВНЕ КОНКУРСА');
                        $html .= <<<HTML
                            <tr><td colspan='{$colspan}' style='text-decoration:underline;'>{$title}</td></tr>
HTML;
                        $html .= $outOfContest;

                        $title = tt('НА ОБЩИХ ОСНОВАНИЯХ');
                        $html .= <<<HTML
                        <tr><td colspan='{$colspan}' style='text-decoration:underline;'>{$title}</td></tr>
HTML;
                    }

                    $html .= empty($inContest)
                                ? generateEmptyRow($colspan)
                                : $inContest;
                }
                echo $html;
            endif;
        ?>


        <?php
            if (! empty($list_3)) :
        ?>
            <tr>
                <td colspan='<?=$colspan?>' class="entrance-rating-title">
                    <?php
                        $amount = '';
                        if (isset($spab11) && isset($spab17))
                            $amount = ' ('.($spab11 - $spab17).')';
                    ?>
                    <?=tt('НА КОНКУРСНОЙ ОСНОВЕ НА ОБЩИХ ОСНОВАНИЯХ').$amount?>
                </td>
            </tr>
            <?php
                $i = 1;
                $html = '';
                foreach ($list_3 as $st) {
                    $html .= generateTr($i, $st, $model);
                    $i++;
                }
                echo $html;
            endif;
            ?>
        <?php endif; ?>

        <?php
            $title = tt('НА КОНТРАКТ');
            $count = 0;

            if (empty($model->cn1))
                $count = $speciality->getAttribute('spab12');
            else
                if (! empty($cnPlan)) $count = $cnPlan->getAttribute('spabk4');

            $title .= " (".$count.")";
            if ($count > 0) :
        ?>
        <tr>
            <td colspan='<?=$colspan?>' class="entrance-rating-title">
                <h4>
                    <?=$title?>
                </h4>
            </td>
        </tr>

        <?php
            if (! empty($list_4)) :
                $title = tt('ВНЕ КОНКУРСА').' ('.$speciality->spab18.')';
        ?>
            <tr><td colspan='<?=$colspan?>'><?=$title?></td></tr>
            <?php
                $i = 1;
                $html = '';
                foreach ($list_4 as $st) {
                    $html .= generateTr($i, $st, $model);
                    $i++;
                }
                echo $html;
            endif;
        ?>


        <?php
            if (! empty($list_5)) :
        ?>
                <tr><td colspan='<?=$colspan?>' class="entrance-rating-title"><?=tt('НА ОБЩИХ ОСНОВАНИЯХ')?></td></tr>
            <?php
                $i = 1;
                $html = '';
                foreach ($list_5 as $st) {
                    $html .= generateTr($i, $st, $model);
                    $i++;
                }
                echo $html;
            endif;
        ?>

        <?php endif; ?>
        </tbody>
    </table>


    <div id="chart1" style="height:400px;width:100%; "></div>

</div>