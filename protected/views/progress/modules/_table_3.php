<?php
function table3Tr($marks,$jpv)
{
    if(empty($jpv))
        return '<td></td>';
    $key = $jpv['jpv4'];
    $mark = isset($marks[$key]) && $marks[$key]['jpvd3'] != 0
        ? round($marks[$key]['jpvd3'], 1)
        : '';
    if(empty($jpv['jpvp2']))
    {
        $pattern= <<<HTML
        <td data-total="%s">
            <input disabled="disabled" value="%s" maxlength="3"/>
        </td>
HTML;
        return sprintf($pattern,$jpv['jpv4'],$mark);
    }else
    {
        $pattern= <<<HTML
        <td data-total="%s" data-jpv1="%s">
            <input value="%s" maxlength="3"/>
        </td>
HTML;
        return sprintf($pattern,$jpv['jpv4'],$jpv['jpv1'],$mark);
    }
}
function generate3Th($key)
{
    $title = $key;
    $pattern_tr = <<<HTML
	<th>
        <span class="blue">%s</span>
    </th>
HTML;
    return sprintf($pattern_tr,$title);
}

function dopMark($marks,$key)
{
    return isset($marks[$key]) && $marks[$key]['jpvd3'] != 0
        ? round($marks[$key]['jpvd3'], 1)
        : 0;
}

    $url = Yii::app()->createUrl('/progress/insertJpvd');

    $table = <<<HTML
<div class="modules_div_table3">
    <table class="table table-striped table-bordered table-hover modules_table"  data-gr1="{$gr1}" data-url="{$url}">
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

$th=$tr='';

$jpvInd=Jpv::model()->getModule($uo1,$gr1,-1);

$jpvExam=Jpv::model()->getModule($uo1,$gr1,-2);

global $total_1;// calculating in journal/table_2
global $count_modules;

$total_2 =array();

$th  .= '<th>'.tt('Сумма').'</th>';
$th  .= '<th>'.tt('Инд.').'</th>';
$th  .= '<th>'.tt('Итог').'</th>';
$th  .= '<th>'.tt('Экз.').'</th>';
$th  .= '<th>'.tt('Всего').'</th>';
$th  .= '<th>'.tt('ECTS').'</th>';
$th  .= '<th>'.tt('Итог(5)').'</th>';

foreach ($students as $st) {
    $st1 = $st['st1'];
    $marks = Jpv::model()->getMarksFromStudentDop($uo1,$gr1,$st1);
    $val=  $total_1[$st1];
    $total_2 = $val + dopMark($marks,-1);
    $total_3 = $total_2 + dopMark($marks,-2);
    $tr.='<tr data-st1="'.$st1.'">';
    $tr .= '<td data-total=1>'.$val.'</td>'; // total 1
    $tr .= table3Tr($marks,$jpvInd); // индивид
    $tr .= '<td data-total=2>'.$total_2.'</td>'; // total 2
    $tr .= table3Tr($marks,$jpvExam); // экзамен
    $tr .= '<td data-total=3>'.$total_3.'</td>'; // total 3
    $tr .= '<td data-total=4></td>'; // total 4
    $tr .= '<td data-total=5></td>'; // total 5
    $tr .= '</tr>';
}
echo sprintf($table,$th,$tr); // 3 table