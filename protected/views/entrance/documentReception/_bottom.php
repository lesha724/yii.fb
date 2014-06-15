<?php
/**
 *
 * @var EntranceController $this
 * @var $model FilterForm
 */

    $isBsaa  = SH::is(U_BSAA);
    $isOseu  = SH::is(U_OSEU);
    $isNulau = SH::is(U_NULAU);
    $showColumns = PortalSettings::model()->findByPk(25)->getAttribute('ps2') == 1;

    list($line1, $line2) = Spab::model()->getDataForSchedule($model);

    $chartTitle = tt('График подачи заявлений абитуриентами');
    $label1     = tt('Общее количество абитуриентов');
    $label2     = tt('Подано оригиналов документов');
    $dateStart  = PortalSettings::model()->findByPk(23)->getAttribute('ps2');
    $dateEnd    = PortalSettings::model()->findByPk(24)->getAttribute('ps2');

    Yii::app()->clientScript->registerScript('chart', <<<JS
        line1 = [$line1];
        line2 = [$line2];
        tt.chartTitle = "$chartTitle";
        tt.label1  = "$label1";
        tt.label2  = "$label2";
        dateStart = "$dateStart";
        dateEnd   = "$dateEnd";
JS
    , CClientScript::POS_END);

$shortForm = $model->extendedForm == 0
?>

<div class="row-fluid" >

    <h3 class="header smaller lighter blue">
        <?=tt('Ход приема документов')?>
        <small>
            <i class="icon-double-angle-right"></i>
            <?=tt($shortForm ? 'Краткая форма' : 'Расширенная форма')?>
        </small>
    </h3>

    <table id="documentReception" class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <?php if ($shortForm) : ?>
                    <th rowspan="2"><?=tt('Специальность')?></th>
                    <th colspan='3'><?=tt('Общий план приема')?></th>
                    <th colspan='3'><?=tt('Подали на бюджет')?></th>
                    <th colspan='6'><?=tt($isBsaa ? 'Подали на договор' : 'Подали на контракт')?></th>
                    <th rowspan='2'><?=tt('Забрали документы')?></th>
                <?php else : ?>
                    <th rowspan='2'><?=tt('Специальность')?></th>
                    <th colspan='3'><?=tt('План приема')?></th>
                    <th colspan='2'><?=tt('Конкурс')?></th>
                    <th colspan='4'><?=tt('Подали на бюджет')?></th>
                    <th colspan='2'><?=tt($isBsaa ? 'Подали на договор' : 'Подали на контракт')?></th>
                    <th colspan='4'><?=tt('Забрали документы')?></th>
                <?php endif; ?>
            </tr>
            <tr>
                <?php if ($shortForm) : ?>
                    <th><?=tt('Всего')?></th>
                    <th><?=tt($isBsaa ? 'ФБ' : 'Б')?></th>
                    <th><?=tt($isBsaa ? 'Д' : 'К')?></th>
                    <th><?=tt('Всего')?></th>
                    <th><?=tt('Документ<br/>(оригинал)')?></th>
                    <th><?=tt('Документ<br/>(копия)')?></th>
                    <th><?=tt('Всего')?></th>
                    <th><?=tt('Документ<br/>(оригинал)')?></th>
                    <th><?=tt('Документ<br/>(копия)')?></th>
                    <th><?=tt('Заключили')?></th>
                    <th><?=tt('Оплатили')?></th>
                    <th><?=tt('Не оплатили')?></th>
                <?php else : ?>
                    <th><?=tt('Всего')?></th>
                    <th><?=tt($isBsaa ? 'ФБ' : 'Б')?></th>
                    <th><?=tt($isBsaa ? 'Д' : 'К')?></th>
                    <th><?=tt('Всего')?></th>
                    <th><?=tt('Конкурс')?></th>
                    <th><?=tt('Всего')?></th>
                    <th><?=tt('Побед.<br/>олимп.')?></th>
                    <th><?=tt('Льготн.')?></th>
                    <th><?=tt('Целевики')?></th>
                    <th><?=tt('Всего')?></th>
                    <th><?=tt('Льготн.')?></th>
                    <th><?=tt('Всего')?></th>
                    <th><?=tt('Бюдж.')?></th>
                    <th><?=tt($isBsaa ? 'Дог.' : 'Конт.')?></th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
        <?php
            $specialities = Spab::model()->getSpecialitiesForEntrance($model);

            $html = '';
            $i = 1;
            $sum = array();
            for($i=1; $i<=13; $i++)
                $sum['v'.$i] = 0;

            foreach ($specialities as $sp) {

                if ($shortForm) {

                    $t = "abd33";
                    if ($isBsaa || ($isOseu && $model->sel_3 != 5))
                        $t = "abd29";

                    $name = ($isNulau && ($sp['spab1'] == 10 || $sp['spab1'] == 16))
                                ? $sp['spab14']
                                : "<a target='_blank' href='#'>".$sp['spab14']."</a>";

                    $sum['v1']  += $sp['v'];
                    $sum['v2']  += $sp['b'];
                    $sum['v3']  += $sp['k'];
                    $sum['v4']  += ($count_1  = Spab::model()->countFor($model, $sp['spab1'], 0));
                    $sum['v5']  += ($count_2  = Spab::model()->countFor($model, $sp['spab1'], 0, "$t=1"));
                    $sum['v6']  += ($count_3  = Spab::model()->countFor($model, $sp['spab1'], 0, "$t=0"));
                    $sum['v7']  += ($count_4  = Spab::model()->countFor($model, $sp['spab1'], 1));
                    $sum['v8']  += ($count_5  = Spab::model()->countFor($model, $sp['spab1'], 1, "$t=1"));
                    $sum['v9']  += ($count_6  = Spab::model()->countFor($model, $sp['spab1'], 1, "$t=0"));
                    $sum['v10'] += ($count_7  = Spab::model()->countFor($model, $sp['spab1'], 1, "ABD44 <> ''"));
                    $sum['v11'] += ($count_8  = Spab::model()->countFor($model, $sp['spab1'], 1, "ABD48 = 1"));
                    $sum['v12'] += ($count_9  = ( ($count_7-$count_8) > 0 ? $count_7-$count_8:'' ));
                    $sum['v13'] += ($count_10 = Spab::model()->countFor($model, $sp['spab1'], "0,1", "ABD12 is not null", 1));

                    if (! $showColumns)
                        $count_7 = $count_8 = $count_9 = $v13 = $v10 = $v11 = '';

                    $html .= <<<HTML
                    <tr>
                        <td>$name</td>
                        <td>$sp[v]</td>
                        <td>$sp[b]</td>
                        <td>$sp[k]</td>
                        <td>$count_1</td>
                        <td>$count_2</td>
                        <td>$count_3</td>
                        <td>$count_4</td>
                        <td>$count_5</td>
                        <td>$count_6</td>
                        <td>$count_7</td>
                        <td>$count_8</td>
                        <td>$count_9</td>
                        <td>$count_10</td>
                    </tr>
HTML;
                } else { // EXTENDED FORM


                    $name = ($isNulau && ($sp['spab1'] == 10 || $sp['spab1'] == 16))
                                ? $sp['spab14']
                                : "<a target='_blank' href='#'>".$sp['spab14']."</a>";

                    $sum['v1']  += $sp['v'];
                    $sum['v2']  += $sp['b'];
                    $sum['v3']  += $sp['k'];
                    $sum['v4']  += ($count_1  = Spab::model()->countFor($model, $sp['spab1'], '0,1'));
                    $count_2  = round($count_1/$sp['v'],1);
                    $sum['v5']  += ($count_3  = Spab::model()->countFor($model, $sp['spab1'], 0));
                    $sum['v6']  += ($count_4  = Spab::model()->countFor($model, $sp['spab1'], 0, "abd4 = 2"));

                    $cond = $isBsaa ?  '(abd4 = 3 or abd66 = 1)' : 'stal3>0';
                    $sum['v7']  += ($count_5  = Spab::model()->countFor($model, $sp['spab1'], 0, $cond, 0, true));

                    $cond = $isBsaa ?  'abd4 in (1,8)' : 'abd6>0';
                    $sum['v8']  += ($count_6  = Spab::model()->countFor($model, $sp['spab1'], 0, $cond));

                    $sum['v9']  += ($count_7  = Spab::model()->countFor($model, $sp['spab1'], 1));

                    $cond = $isBsaa ?  '(abd4 = 3 or abd66 = 1)' : 'STAL3>0';
                    $sum['v10'] += ($count_8  = Spab::model()->countFor($model, $sp['spab1'], 1, $cond, 0, true));

                    $sum['v11'] += ($count_9  = Spab::model()->countFor($model, $sp['spab1'], '0,1', "ABD12 is not null", 1));
                    $sum['v12'] += ($count_10 = Spab::model()->countFor($model, $sp['spab1'], 0, "ABD12 is not null", 1));
                    $sum['v13'] += ($count_11 = Spab::model()->countFor($model, $sp['spab1'], 1, "ABD12 is not null", 1));

                    $html .= <<<HTML
                    <tr>
                        <td>$name</td>
                        <td>$sp[v]</td>
                        <td>$sp[b]</td>
                        <td>$sp[k]</td>
                        <td>$count_1</td>
                        <td>$count_2</td>
                        <td>$count_3</td>
                        <td>$count_4</td>
                        <td>$count_5</td>
                        <td>$count_6</td>
                        <td>$count_7</td>
                        <td>$count_8</td>
                        <td>$count_9</td>
                        <td>$count_10</td>
                        <td>$count_11</td>
                    </tr>
HTML;
                }
                $i++;
            }

        foreach ($sum as $key=>$val) {
            if ($val == 0)
                $sum[$key] = '';
        }

        if ($shortForm) {
            $html .= <<<HTML
                <tr>
                    <td></td>
                    <td>$sum[v1]</td>
                    <td>$sum[v2]</td>
                    <td>$sum[v3]</td>
                    <td>$sum[v4]</td>
                    <td>$sum[v5]</td>
                    <td>$sum[v6]</td>
                    <td>$sum[v7]</td>
                    <td>$sum[v8]</td>
                    <td>$sum[v9]</td>
                    <td>$sum[v10]</td>
                    <td>$sum[v11]</td>
                    <td>$sum[v12]</td>
                    <td>$sum[v13]</td>
                </tr>
HTML;
        } else {

            $percent = round($sum['v4']/$sum['v1'],1);
            $html .= <<<HTML
                <tr>
                    <td></td>
                    <td>$sum[v1]</td>
                    <td>$sum[v2]</td>
                    <td>$sum[v3]</td>
                    <td>$sum[v4]</td>
                    <td>$percent</td>
                    <td>$sum[v5]</td>
                    <td>$sum[v6]</td>
                    <td>$sum[v7]</td>
                    <td>$sum[v8]</td>
                    <td>$sum[v9]</td>
                    <td>$sum[v10]</td>
                    <td>$sum[v11]</td>
                    <td>$sum[v12]</td>
                    <td>$sum[v13]</td>
                </tr>
HTML;
        }
            echo $html;
        ?>
        </tbody>
    </table>


    <div id="chart1" style="height:400px;width:100%; "></div>

</div>