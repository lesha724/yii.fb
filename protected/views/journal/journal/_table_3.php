<?php
function table3Tr($column, $marks,$st1,$elg1)
{
    $tr= <<<HTML
<td><input class="elgdst-input" value="%s" data-name="%s" maxlength="3"></td>
HTML;

    //list($field, $name) = $column;
    $key=$column['elgsd1'];

    $mark = isset($marks[$key]) && $marks[$key] != 0
        ? round($marks[$key], 1)
        : '';

    return sprintf($tr, $mark, $key);
}
function generate3Th($key)
{
    $pattern_tr = <<<HTML
	<th class="blue">
        %s
    </th>
HTML;
    return sprintf($pattern_tr,$key['elgsd2']);
}

function generate3Th2($key)
{
    return '<th></th>';
}

function generateTotal1Header()
{
    $pattern = <<<HTML
        <th colspan="2" class="blue">%s</th>
HTML;
    $name = tt('Итого');

    return sprintf($pattern, $name);
}

    $elg1=$elg->elg1;
    $url = Yii::app()->createUrl('/journal/insertDopMark');

    $table = <<<HTML
<div class="journal_div_table3">
    <table class="table table-striped table-bordered table-hover journal_table"  data-url="{$url}" data-elg1="{$elg1}">
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

$th=$th2=$tr='';

$th  .= generateTotal1Header();
$th2.='<th colspan="2"></th>';

foreach($elgd as $key)
{
    $th.=generate3Th($key);
    $th2.='<th></th>';
}

$th  .= '<th>'.tt('Всего').'</th>';
$th2 .= '<th></th>';

foreach ($students as $st) {
    $st1 = $st['st1'];
    $marks=Elgdst::model()->getMarksForStudent($st1,$elg1);
    $tr.='<tr data-st1="'.$st1.'">';
    $tr .= '<td data-total=1 colspan="2"></td>'; // total 1
        foreach($elgd as $key)
        {
            $tr .= table3Tr($key, $marks, $st1,$elg1);
        }
    $tr .= '<td data-total=2></td>'; // total 2
    $tr .= '</tr>';
}
echo sprintf($table,$th,$th2,$tr); // 3 table