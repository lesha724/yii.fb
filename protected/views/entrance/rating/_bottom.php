<?php
/**
 *
 * @var EntranceController $this
 * @var $model FilterForm
 */

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
    list($td1, $td2) = getDocumentTypeFor($st, $model);

    $mark = round($st['abd20'], 3);
    $tr = <<<HTML
            <tr>
                <td>$i</td>
                <td>$st[ab2]</td>
                <td>$st[ab3]</td>
                <td>$st[ab4]</td>
                <td>$mark</td>
                <td>{$td1}</td>
                <td>{$td2}</td>
                <td>$st[notice]</td>
            </tr>
HTML;

    return $tr;

}


    $isBsaa  = SH::is(U_BSAA);
    $isOseu  = SH::is(U_OSEU);
    $isNulau = SH::is(U_NULAU);

    Yii::app()->clientScript->registerScript('chart', <<<JS

JS
    , CClientScript::POS_END);


$speciality = Spab::model()->findByPk($model->speciality);
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
                <th rowspan="2"><?=tt('№ п/п')?></th>
                <th rowspan="2"><?=tt('Фамилия')?></th>
                <th rowspan="2"><?=tt('Имя')?></th>
                <th rowspan="2"><?=tt('Отчество')?></th>
                <th rowspan="2" style="width:5%"><?=tt('Сумма баллов')?></th>
                <th colspan="2"><?=tt('Документы')?></th>
                <th rowspan="2"><?=tt('Примечание')?></th>
            </tr>
            <tr>
                <th style="width:5%"><?=tt('Копия')?></th>
                <th style="width:5%"><?=tt('Оригинал')?></th>
            </tr>
        </thead>
        <tbody>
        <tr>
            <td colspan="8" class="entrance-rating-title">
                <h4>
                    <?php
                        $title  = $isBsaa ? tt("НА ФЕДЕРАЛЬНЫЙ БЮДЖЕТ") : tt("НА БЮДЖЕТНОЙ ОСНОВЕ");
                        $spab11 = $speciality->getAttribute('spab11');
                        $title .= " (".$spab11.")";
                        echo $title;
                    ?>
                </h4>
            </td>
        </tr>

        <?php
            if (! empty($list_1)) :
        ?>
                <tr>
                    <td colspan='8'>
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
                    $cns = Cn::model()->findByPk($model->cn1);
                else
                    $cns = Cn::model()->getAllCn();

                foreach ($cns as $cn) {

                    $list = Ab::model()->getStudents($model, 0, 'ABD6='.$cn->cn1);

                    $title = $cn->cn2.' ('.Spabk::model()->getBudgetAndContract($model->speciality, $cn->cn1).')';
                    $html .= <<<HTML
                        <tr><td colspan='8' style='text-decoration:underline;'>{$title}</td></tr>
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
                        $title = tt('Вне конкурса');
                        $html .= <<<HTML
                            <tr><td colspan='8' style='text-decoration:underline;'>{$title}</td></tr>
HTML;
                        $html .= $outOfContest;
                    }

                    $title = tt('На общих основаниях');
                    $html .= <<<HTML
                        <tr><td colspan='8' style='text-decoration:underline;'>{$title}</td></tr>
HTML;

                }
                echo $html;
            endif;
        ?>


        <?php
            if (! empty($list_3)) :
        ?>
            <tr>
                <td colspan='8'>
                    <?php
                        $amount = '';
                        if (isset($spab11) && isset($spab17))
                            $amount = ' ('.($spab11 - $spab17).')';
                    ?>
                    <?=tt('На конкурсной основе на общих основаниях').$amount?>
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

        <tr>
            <td colspan="8" class="entrance-rating-title">
                <h4>
                    <?php
                        $title   = tt('НА КОНТРАКТ');
                        $spab12 = $speciality->getAttribute('spab12');
                        $title  .= " (".$spab12.")";
                        echo $title;
                    ?>
                </h4>
            </td>
        </tr>

        <?php
            if (! empty($list_4)) :
        ?>
            <tr><td colspan='8'><?=tt('ВНЕ КОНКУРСА')?></td></tr>
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
                <tr><td colspan='8'><?=tt('На общих основаниях')?></td></tr>
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

        </tbody>
    </table>


    <div id="chart1" style="height:400px;width:100%; "></div>

</div>