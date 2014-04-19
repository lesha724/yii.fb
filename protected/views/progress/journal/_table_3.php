<?php
function table3Tr($column, $marks)
{
    $nr1 = $marks['dsej3'];
    $tr= <<<HTML
<td data-nr1="{$nr1}"><input value="%s" data-name="%s" maxlength="3"></td>
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

function generateTotal1Header($ps20)
{
    $pattern = <<<HTML
        <th colspan="2">%s</th>
HTML;

    if ($ps20 == 1)
        $name = tt('Итого по субмодулям');
    else
        $name = tt('Итого');

    return sprintf($pattern, $name);
}

    $url = Yii::app()->createUrl('/progress/insertDsejMark');
    $table = <<<HTML
<div class="journal_div_table3" data-url="{$url}">
    <table class="table table-striped table-bordered table-hover journal_table">
        <thead>
            <tr>
                %s
            </tr>
            <tr class="min-max">
                %s
            </tr>
        </thead>
        <tbody>
            %s
        </tbody>
    </table>
</div>
HTML;



    $columns     = PortalSettings::model()->getJournalExtraColumns();
    $showTotal   = !empty($columns);

    $th  = generateTotal1Header($ps20);
    $th2 = table3Th2($nr1, $ps9);

    foreach($columns as $column) {
        list($field, $name) = $column;
        $th  .= '<th>'.$name.'</th>';
        $th2 .= '<th></th>';
    }
    $th  .= '<th>'.tt('Всего').'</th>';
    $th2 .= '<th></th>';

    global $total_1;// calculating in journal/table_2
    $tr = '';
    foreach ($students as $st) {

        $st1 = $st['st1'];

        $marks = Dsej::model()->getMarksForStudent($st['st1'], $nr1);
        $total_2[$st1] = $total_1[$st1] + countDSEJTotal($marks, $columns);

        $tr .= '<tr data-st1="'.$st1.'">';

            $tr .= '<td data-total=1 colspan="2">'.$total_1[$st1].'</td>'; // total 1
            foreach($columns as $column) {
                $tr .= table3Tr($column, $marks);
            }
            $tr .= '<td data-total=2>'.$total_2[$st1].'</td>'; // total 2

        $tr .= '</tr>';

    }

    echo sprintf($table, $th, $th2, $tr); // 3 table