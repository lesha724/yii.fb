<?php
function table2Tr($date, $marks)
{
    if (strtotime($date['r2']) > strtotime('now'))
        return '<td colspan="2"></td>';

    $r2 = $date['r2'];
    $pattern= <<<HTML
    <td colspan="2" data-r2="{$r2}">
        <input type="checkbox" %s data-name="steg6">
        <input value="%s" maxlength="3" data-name="steg5">
        <input value="%s" maxlength="3" data-name="steg9">
    </td>
HTML;

    $key = $date['r2'].'/0'; // 0 - r3

    $steg6 = isset($marks[$key]) && $marks[$key]['steg6'] == 0
                ? 'checked'
                : '';

    $steg5 = isset($marks[$key]) && $marks[$key]['steg5'] != 0
                ? round($marks[$key]['steg5'], 1)
                : '';

    $steg9 = isset($marks[$key]) && $marks[$key]['steg9'] != 0
                ? round($marks[$key]['steg9'], 1)
                : '';

    return sprintf($pattern, $steg6, $steg5, $steg9);
}

function countSTEGTotal($marks)
{
    $total = 0;
    foreach ($marks as $mark) {
        $total += $mark['steg9'] != 0
                    ? $mark['steg9']
                    : $mark['steg5'];
    }
    return $total;
}

function generateTh2($minMax, $column)
{
    if (! isset($minMax[$column]))
        return '<th></th><th></th>';

    $marks = $minMax[$column];
    $mmbj1 = $marks['mmbj1'];
    $mmbj4 = round($marks['mmbj4'], 1);
    $mmbj5 = round($marks['mmbj5'], 1);

    $pattern = <<<HTML
<th><input value="{$mmbj4}" maxlength="3" placeholder="min" data-name="mmbj4" data-mmbj1="{$mmbj1}"></th>
<th><input value="{$mmbj5}" maxlength="3" placeholder="max" data-name="mmbj5" data-mmbj1="{$mmbj1}"></th>
HTML;

    return sprintf($pattern);
}

    $url       = Yii::app()->createUrl('/progress/insertStegMark');
    $minMaxUrl = Yii::app()->createUrl('/progress/insertMmbjMark');
    $table = <<<HTML
<div class="journal_div_table2" data-url="{$url}">
    <table class="table table-striped table-bordered table-hover journal_table">
        <thead>
            <tr>
                %s
            </tr>
            <tr class="min-max" data-url="{$minMaxUrl}">
                %s
            </tr>
        </thead>
        <tbody>
            %s
        </tbody>
    </table>
</div>
HTML;

    $minMax = Mmbj::model()->getDataFor($nr1);

    /*** 2 table ***/
    $th = $th2 = '';
    $column = 1;
    foreach($dates as $date) {
        $th    .= '<th colspan="2">'.$date['formatted_date'].' '.SH::convertUS4($date['us4']).'</th>';
        $th2   .= generateTh2($minMax, $column);
        $column++;
    }

    global $total_1;
    $tr = '';
    foreach($students as $st) {

        $st1 = $st['st1'];

        $marks = Steg::model()->getMarksForStudent($st1, $nr1);
        $total_1[$st1] = countSTEGTotal($marks);

        $tr .= '<tr data-st1="'.$st1.'">';
        foreach($dates as $date) {
            $tr .= table2Tr($date, $marks).'</td>';
        }
        $tr .= '</tr>';
    }
    echo sprintf($table, $th, $th2, $tr); // 2 table


