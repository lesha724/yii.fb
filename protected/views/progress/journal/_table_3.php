<?php
function table3Tr($column, $marks)
{
    $tr= <<<HTML
<td><input value="%s" data-name="%s" maxlength="3"></td>
HTML;

    list($field, $name) = $column;

    $mark = isset($marks[$field]) && $marks[$field] != 0
                ? round($marks[$field], 1)
                : '';

    return sprintf($tr, $mark, $field);
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
    $table = <<<HTML
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

    $th = '<th>'.tt('Итого').'</th>';
    foreach($columns as $column) {
        list($field, $name) = $column;
        $th .= '<th>'.$name.'</th>';
    }
    $th .= '<th>'.tt('Всего').'</th>';

    global $total_1;// calculating in journal/table_2
    $tr = '';
    foreach ($students as $st) {

        $marks = Dsej::model()->getMarksForStudent($st['st1'], $nr1);
        $total_2[$st['st1']] = $total_1[$st['st1']] + countDSEJTotal($marks, $columns);

        $tr .= '<tr data-st1="'.$st['st1'].'">';

            $tr .= '<td data-total=1>'.$total_1[$st['st1']].'</td>'; // total 1
            foreach($columns as $column) {
                $tr .= table3Tr($column, $marks);
            }
            $tr .= '<td data-total=2>'.$total_2[$st['st1']].'</td>'; // total 2

        $tr .= '</tr>';
    }

    echo sprintf($table, $th, $tr); // 3 table