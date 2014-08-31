<style>
    tr.semester-title td, tr.label-success td:first-child {
        text-align: center;
        text-transform: uppercase;
        font-weight: bold;
    }
    tr.headline {
        background: linear-gradient(to bottom, #f8f8f8, #ddd) repeat-x scroll 0 0 #f3f3f3;
        color: #707070;
        font-weight: bold;
    }

    tr.label-success > td {
        background-color: transparent !important;
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

    $options = array('class'=>'chosen-select', 'autocomplete' => 'off', 'empty' => tt('&nbsp;'), 'style' => 'width:200px');

    $html  = '<div class="row-fluid span2 no-margin">';
    $html .= CHtml::label(tt('Учебный год'), 'FilterForm_year');
    $html .= CHtml::dropDownList('FilterForm[year]', $model->year, $data, $options);
    $html .= '</div>';

    $html .= '<div class="row-fluid span2">';
    $html .= CHtml::label(tt('Расширенная форма'), 'FilterForm_extendedForm');
    $html .= '<label>';
    $html .= CHtml::checkBox('FilterForm[extendedForm]', $model->extendedForm==1, array('value' =>$model->extendedForm,  'class' => 'ace ace-switch ace-switch-6'));
    $html .= '<span class="lbl"></span>';
    $html .= '</label>';
    $html .= '</div>';

    $button =  <<<HTML
        <div class="row-fluid span2 submit-bottom" style="padding:23px 0 0 0">
            <button class="btn btn-info btn-small">
                <i class="icon-key bigger-110"></i>
                %s
            </button>
        </div>
HTML;
    $html .= sprintf($button, tt('Ок'));

    echo $html;


    if (! empty($model->year)) : ?>

    <table class="table table-striped table-bordered table-hover" style="margin-top:7%">

    <?php
        $types = array(
            //0 => tt('Всего'),
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

        $total = array();

        for ($sem5=0; $sem5<=1; $sem5++) : ?>
            <tr></tr> <!-- hack, do not remove this row -->
            <tr class="headline">
                <td style="width:25%"><?=tt('Дисциплины')?></td>
                <td><?=tt('Группы')?></td>
                <td><?=tt('Кол-во чел.')?></td>
                <td><?=tt('Всего')?></td>
                <?php
                    foreach ($types as $name)
                        echo '<td>'.$name.'</td>';
                ?>
            </tr>
            <tr class="semester-title">
                <td colspan='22'><?=SH::convertSem5($sem5).' '.tt('семестр')?></td>
            </tr>
            <?php
                $model->semester = $sem5;
                $disciplines = D::model()->getDisciplinesForWorkLoadAmount($model);

                $html = '';
                foreach ($disciplines as $discipline) {

                    $td1 = $discipline['d2'];
                    $td2 = implode(', ',$discipline['groups']);
                    $td3 = $discipline['studentsAmount'];
                    $td4 = array_sum($discipline['hours']);

                    $html .= '<tr>';
                    $html .= <<<HTML
                                  <td>{$td1}</td>
                                  <td>{$td2}</td>
                                  <td>{$td3}</td>
                                  <td>{$td4}</td>
HTML;
                    $hours = $discipline['hours'];
                    foreach ($types as $type=>$name) {
                        $val   = isset($hours[$type]) ? $hours[$type] : '';
                        $html .= '<td>'.$val.'</td>';
                    }
                    $html .= '</tr>';
                }

                // last raw for each semester
                $raw = <<<HTML
                        <tr class="label-success">
                            <td colspan="2">%s</td>
                            <td></td>
                            <td>%s</td>
HTML;
                $sum = array();
                foreach ($types as $type=>$name) {

                    if (! isset($sum[$type]))
                        $sum[$type] = null;
                    if (! isset($total[$type]))
                        $total[$type] = null;

                    foreach ($disciplines as $discipline) {
                        if (isset($discipline['hours'][$type])) {
                            $hours = $discipline['hours'][$type];
                            $sum[$type]   += $hours;
                            $total[$type] += $hours;
                        }
                    }

                    $raw .= '<td>'.$sum[$type].'</td>';
                }

                $raw .= '</tr>';
                $html .= sprintf($raw, tt('Всего в семестре'), array_sum($sum));
                echo $html;
         endfor;

            // Year Total
            $translate = tt('Всего в году');
            $totalSum = array_sum($total);
            $html = <<<HTML
            <tr class="label-success">
                <td colspan="2">{$translate}</td>
                <td></td>
                <td>{$totalSum}</td>
HTML;
            foreach ($types as $type=>$name) {
                $val   = isset($total[$type]) ? $total[$type] : '';
                $html .= '<td>'.$val.'</td>';
            }

            $html .= '</tr>';

            echo $html;
        ?>

    </table>

<?php endif ?>

