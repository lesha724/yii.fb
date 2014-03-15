<?php
function generateTable2Tr($date, $marks)
{
    if (strtotime($date['r2']) > strtotime('now'))
        return null;

    $pattern= <<<HTML
            <input type="checkbox" %s data-name="steg6">
            <input value="%s" maxlength="3" data-name="steg5">
            <input value="%s" maxlength="3" data-name="steg9">
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

    $url = Yii::app()->createUrl('/progress/insertStegMark');
    $table_2 = <<<HTML
<div class="journal_div_table2" data-url="{$url}">
    <table class="table table-striped table-bordered table-hover journal_table">
        <thead>
            <tr>
                %s
            </tr>
        </thead>
        <tbody>
            %s
        </tbody>
    </table>
</div>
HTML;

    /*** 2 table ***/
    $table_2_th = '';
    foreach($dates as $date)
        $table_2_th .= '<th>'.$date['formatted_date'].'</th>';


    $table_2_tr = '';
    foreach($students as $st) {

        $marks = Steg::model()->getMarksForStudent($st['st1'], $nr1);

        $table_2_tr .= '<tr data-st1="'.$st['st1'].'">';
        foreach($dates as $date) {
            $table_2_tr .= '<td data-r2="'.$date['r2'].'">'.generateTable2Tr($date, $marks).'</td>';
        }
        $table_2_tr .= '</tr>';
    }
    echo sprintf($table_2, $table_2_th, $table_2_tr); // 2 table


