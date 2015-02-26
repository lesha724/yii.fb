<?php
function table3Tr($field, $marks, $isClosed)
{

    $data_url = $field === 'stus3'
              ? 'data-url="'.Yii::app()->createUrl('progress/updateStus').'"'
              : '';

    $tr= <<<HTML
<td {$data_url}><input value="%s" data-name="%s" data-module="%s" maxlength="3" %s></td>
HTML;

    $mark = isset($marks[$field]) && $marks[$field] != 0
                ? round($marks[$field], 1)
                : '';

    $disabled = '';

    if ($field === '0' || $field === '-1') {
        $name = 'vmp4';
        $module = $field;
    } else {
        $name = 'stus3';
        $module = '';
        if ($marks[$field] === false)
            $disabled = 'disabled="disabled"';
    }

    if ($isClosed)
        $disabled = 'disabled="disabled"';

    return sprintf($tr, $mark, $name, $module, $disabled);
}


function table3Th2($nr1, $ps9)
{
    if ($ps9 == '0')
        return '<th></th><th></th>';

    $total = Mmbj::model()->getTotalFor($nr1);
    $th2 = <<<HTML
<th data-total='mmbj4'>%s</th>
<th data-total='mmbj5'>%s</th>
HTML;

    return sprintf($th2, $total['min'], $total['max']);
}

    $url = Yii::app()->createUrl('/progress/insertVmpMark');
    $table = <<<HTML
<div class="journal_div_table3" >
    <table class="table table-striped table-bordered table-hover journal_table modules_table_3">
        <thead>
            <tr>
                %s
            </tr>
        </thead>
        <tbody data-url="{$url}">
            %s
        </tbody>
    </table>
</div>
HTML;



    $columns   = PortalSettings::model()->getModuleExtraColumns();
    $showTotal = !empty($columns);

    $th  = '<th>'.tt('Сумма').'</th>';

    // first 2 columns
    $firstTwoColumn = !empty($columns['total1']);
    if ($firstTwoColumn) {
        foreach($columns['total1'] as $column) {
            list(,$name) = $column;
            $th  .= '<th>'.$name.'</th>';
        }
        $th  .= '<th>'.tt('Итог').'</th>';
    }
    // last column
    $lastColumn = !empty($columns['total2']);
    if ($lastColumn) {
        foreach($columns['total2'] as $column) {
            list(,$name) = $column;
            $th  .= '<th>'.$name.'</th>';
        }

        $th  .= '<th>'.tt('Всего').'</th>';
    }


    global $total_1;// calculating in modules/table_2
    $tr = '';
    foreach ($students as $st) {

        $st1 = $st['st1'];

        //$marks = Dsej::model()->getMarksForStudent($st['st1'], $nr1);
        //$total_2[$st1] = $total_1[$st1] + countDSEJTotal($marks, $columns);

        $tr .= '<tr data-st1="'.$st1.'">';

            $tr .= '<td data-total=1 >'.$total_1[$st1].'</td>'; // total 1

            $marks = Vmp::model()->getExtraMarks($st['st1'], $vvmp1);

            // first 2 columns
            $total_2[$st1] = 0;
            if ($firstTwoColumn) {

                $total_2[$st1] = $total_1[$st1] + $marks['0'] + $marks['stus3'];

                foreach($columns['total1'] as $column) {
                    list($field, $name) = $column;
                    $tr  .= table3Tr($field, $marks, $isClosed);
                }
                $tr  .= '<td data-total=2 >'.$total_2[$st1].'</td>';
            }

            if ($lastColumn) {

                $total_3[$st1] = $total_2[$st1] + $marks['-1'];

                foreach($columns['total2'] as $column) {
                    list($field, $name) = $column;
                    $tr  .= table3Tr($field, $marks, $isClosed);
                }

                $tr  .= '<td data-total=3 >'.$total_3[$st1].'</td>';
            }

        $tr .= '</tr>';

    }

    echo sprintf($table, $th, $tr); // 3 table