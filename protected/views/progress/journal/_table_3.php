<?php
function generateTable3Tr($column, $marks)
{
    $table_3_tr= <<<HTML
<td><input value="%s" data-name="%s" maxlength="3"></td>
HTML;

    list($field, $name) = $column;

    $mark = isset($marks[$field]) && $marks[$field] != 0
                ? round($marks[$field], 1)
                : '';

    return sprintf($table_3_tr, $mark, $field);
}

function countDSEJTotal($marks, $columns)
{
    $total = 0;
    foreach ($columns as $column) {
        list($field, $name) = $column;
        $total += $marks[$field];
    }

    return $total;
}



    $url = Yii::app()->createUrl('/progress/insertDsejMark');
    $table_3 = <<<HTML
<div class="journal_div_table3" data-url="{$url}">
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



    $columns = PortalSettings::model()->getJournalExtraColumns();
    $showTotal = !empty($columns);

    $table_3_th = '';
    foreach($columns as $column) {
        list($field, $name) = $column;
        $table_3_th .= '<th>'.$name.'</th>';
    }
    $table_3_th .= '<th>'.tt('Всего').'</th>';

    global $total;
    $table_3_trs = '';
    foreach ($students as $st) {

        $marks = Dsej::model()->getMarksForStudent($st['st1'], $nr1);
        $total[$st['st1']] += countDSEJTotal($marks, $columns);

        $table_3_trs .= '<tr data-st1="'.$st['st1'].'">';
        foreach($columns as $column) {
            $table_3_trs .= generateTable3Tr($column, $marks);
        }
        $table_3_trs .= '<td>'.$total[$st['st1']].'</td>'; // total

        $table_3_trs .= '</tr>';
    }

    echo sprintf($table_3, $table_3_th, $table_3_trs); // 3 table