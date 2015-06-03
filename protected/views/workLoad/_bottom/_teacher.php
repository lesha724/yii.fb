<style>
.table thead tr, .table tfoot tr {
    background: linear-gradient(to bottom, #f8f8f8, #ececec) repeat-x scroll 0 0 #f3f3f3;
    color: #707070;
    font-weight: normal;
}
</style>
<?php
/**
 * @var FilterForm $model
 */

    $previousYear = date('Y', strtotime('-1 year'));
    $currentYear  = date('Y');
    $nextYear     = date('Y', strtotime('+1 year'));

    $data = array(
        $previousYear => $previousYear.'/'.$currentYear,
        $currentYear  => $currentYear.'/'.$nextYear,
    );

    $options = array('class'=>'chosen-select', 'autocomplete' => 'off', 'empty' => '&nbsp;', 'style' => 'width:200px');

    $html  = '<div class="row-fluid">';
    $html .= CHtml::label(tt('Учебный год'), 'FilterForm_year');
    $html .= CHtml::dropDownList('FilterForm[year]', $model->year, $data, $options);
    $html .= '</div>';

    echo $html;


    if (! empty($model->year)) :

        $hours = Us::model()->getHoursForWorkLoad($model->teacher, $model->year);

        $types = array(
            0 => tt('Всего'),
            1 => tt('Лк'),
            2 => tt('Пз'),
            3 => tt('Сем'),
            4 => tt('Лб'),
            5 => tt('Экз'),
            6 => tt('Зч'),
            7 => tt('Кр'),
            8 => tt('КП'),
            13 => tt('Доп'),
            14 => tt('Инд'),
            16 => tt('КнЧ'),
            17 => tt('Конс'),
            18 => tt('Пер'),

            'Prak' => tt('Прак'),
            'Dipl' => tt('Дипл'),
            'Gek'  => tt('ГЭК'),
            'Asp'  => tt('Асп'),
            'Dop'  => tt('Доп'),
        );

        ?>

        <table class="table table-striped table-bordered table-hover" style="margin-top:2%">
            <thead>
                <tr>
                    <th><?=tt('Семестр')?></th>
                    <?php
                        foreach ($types as $name)
                            echo '<th>'.$name.'</th>';
                    ?>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <td><?=tt('Всего за год')?></td>
                    <?php
                        $html = '';
                        foreach ($types as $type=>$name) {

                            $val_1 = isset($hours[0][$type]) ? $hours[0][$type]['sum'] : 0;
                            $val_2 = isset($hours[1][$type]) ? $hours[1][$type]['sum'] : 0;

                            $sum = $val_1 + $val_2;
                            if ($sum == 0) $sum = '';

                            $html .= '<td>'.$sum.'</td>';
                        }
                        echo $html;
                    ?>
                </tr>
            </tfoot>
            <tbody>
                <?php
                    $html = '';
                    foreach ($hours as $sem5 => $arr) {

                        $isActive = $model->semester == $sem5 ? 'label-yellow' : '';
                        $html .= '<tr>
                                      <td class="'.$isActive.'">'.CHtml::link(SH::convertSem5($sem5), '#', array('data-semester' => $sem5)).'</td>';
                        foreach ($types as $type=>$name) {
                            $val = isset($arr[$type]) && $arr[$type]['sum'] > 0 ? round($arr[$type]['sum']) : '';
                            $html .= '<td>'.$val.'</td>';
                        }

                        $html .= '</tr>';
                    }
                    echo $html;
                ?>
            </tbody>
        </table>


        <?php
            // todo refactor gek dipl an so on
            $disciplines = D::model()->getDisciplinesForWorkLoad($model);

            $getGroupUrl = Yii::app()->createUrl('workLoad/getGroups');
        ?>

        <table id="disciplines" class="table table-striped table-bordered table-hover small-rows" style="margin-top:2%" data-getGroupUrl="<?=$getGroupUrl?>">
            <thead>
                <tr>
                    <th>№</th>
                    <th style="width:25%"><?=tt('Дисциплина')?></th>
                    <th><?=tt('Тип занятия')?></th>
                    <th><?=tt('Кол. часов')?></th>
                    <th><?=tt('Группы')?></th>
                </tr>
            </thead>
            <tbody>
            <?php
                $html = '';
                foreach ($disciplines as $key => $discipline) {

                    $i = ++$key;
                    $td3 = SH::convertUS4($discipline['us4']);
                    $td4 = array_sum($discipline['hours']);
                    $td5 = implode(', ', $discipline['groups']);
					$nr1=$discipline['nr1'];

                    if (! empty($td5)) {
                        $tip  = tt('Нажмите для просмотра списка студентов');
                        $ids  = serialize($discipline['ids']);

                        $td5  = <<<HTML
                        <button class="btn btn-minier btn-yellow tooltip-info"
                                data-rel="tooltip"
                                data-placement="bottom"
								data-type="{$nr1}"
                                data-original-title="{$tip}">
                            <i class="icon-eye-open"></i>
                        </button>
                        <input name="ids" type="hidden" value='{$ids}'>
                        <input name="sem4" type="hidden" value='{$ids}'>
                        {$td5}
HTML;
                    }



                    $html .= <<<HTML
                        <tr>
                            <td>{$i}</td>
                            <td>{$discipline['d2']}</td>
                            <td>{$td3}</td>
                            <td>{$td4}</td>
                            <td>{$td5}</td>
                        </tr>
HTML;

                }
                echo $html;
            ?>
            </tbody>
        </table>

        <div id="groups"></div>
<?php endif ?>

