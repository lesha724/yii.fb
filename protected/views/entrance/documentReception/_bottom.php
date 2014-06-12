<?php
/**
 *
 * @var EntranceController $this
 * @var $model FilterForm
 */

$isBsaa  = Yii::app()->params['code'] == U_BSAA;
$isOseu  = Yii::app()->params['code'] == U_OSEU;
$isNulau = Yii::app()->params['code'] == U_NULAU;
$showColumns = PortalSettings::model()->findByPk(25)->getAttribute('ps2') == 1;

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
            $specialities = Spab::model()->getSpecialitiesForDocumentReception($model);

            $html = '';
            $i = 1;
            $v1=$v2=$v3=$v4=$v5=$v6=$v7=$v8=$v9=$v10=$v11=$v12=$v13=0;
            foreach ($specialities as $sp) {

                if ($shortForm) {

                    $t = "abd33";
                    if ($isBsaa || ($isOseu && $model->sel_3 != 5))
                        $t = "abd29";

                    $name = ($isNulau && ($sp['spab1'] == 10 || $sp['spab1'] == 16))
                                ? $sp['spab14']
                                : "<a target='_blank' href='#'>".$sp['spab14']."</a>";

                    $v1  += $sp['v'];
                    $v2  += $sp['b'];
                    $v3  += $sp['k'];
                    $v4  += ($count_1  = Spab::model()->countFor($model, $sp['spab1'], 0));
                    $v5  += ($count_2  = Spab::model()->countFor($model, $sp['spab1'], 0, "$t=1"));
                    $v6  += ($count_3  = Spab::model()->countFor($model, $sp['spab1'], 0, "$t=0"));
                    $v7  += ($count_4  = Spab::model()->countFor($model, $sp['spab1'], 1));
                    $v8  += ($count_5  = Spab::model()->countFor($model, $sp['spab1'], 1, "$t=1"));
                    $v9  += ($count_6  = Spab::model()->countFor($model, $sp['spab1'], 1, "$t=0"));
                    $v10 += ($count_7  = Spab::model()->countFor($model, $sp['spab1'], 1, "ABD44 <> ''"));
                    $v11 += ($count_8  = Spab::model()->countFor($model, $sp['spab1'], 1, "ABD48 = 1"));
                    $v12 += ($count_9  = $count_7 - $count_8);
                    $v12 += ($count_10 = Spab::model()->countFor($model, $sp['spab1'], "0,1", "ABD12 is not null", 1));

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
                }
                $i++;
            }

            if ($shortForm) {
                $html .= <<<HTML
                    <tr>
                        <td></td>
                        <td>$v1</td>
                        <td>$v2</td>
                        <td>$v3</td>
                        <td>$v4</td>
                        <td>$v5</td>
                        <td>$v6</td>
                        <td>$v7</td>
                        <td>$v8</td>
                        <td>$v9</td>
                        <td>$v10</td>
                        <td>$v11</td>
                        <td>$v12</td>
                        <td>$v13</td>
                    </tr>
HTML;
            }
            echo $html;
        ?>
        </tbody>
    </table>
</div>