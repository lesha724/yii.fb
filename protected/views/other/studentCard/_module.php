<?php
/**
 * Created by PhpStorm.
 * User: Neff
 * Date: 27.11.2015
 * Time: 11:23
 */

function getBal($bal,$total3)
{
    $ects=$bal5="-";
    foreach($bal as $key)
    {
        if(($total3>=$key['cxmb4'])&&($total3<=$key['cxmb5']))
        {
            $ects = $key['cxmb3'];
            $bal5 = $key['cxmb2'];
        }
    }
    return array($ects,$bal5);
}
function dopMark($marks,$key)
{
    return isset($marks[$key]) && $marks[$key]['jpvd3'] != 0
        ? round($marks[$key]['jpvd3'], 1)
        : 0;
}
$bal = Cxmb::model()->findAll();
$ps42 = PortalSettings::model()->findByPk(42)->ps2;
list($modules,$arr) = Jpv::model()->getModuleFromStudentCard($gr1);
list($maxCount,$exam,$ind) = $arr;
$table =<<<HTML
    <table class="table">
        <thead>
            <tr>%s</tr>
        </thead>
        <tbody>
            %s
        </tbody>
    </table >
HTML;

$tr = $th = '';

$th = '<th>'.tt('Дисцилина').'</th>';
for ($i=1; $i<=$maxCount;$i++)
{
    $th.='<th>'.tt('Модул №').$i.'</th>';
}
if($ps42==1) {
    $th .= '<th>'.tt('Сумма').'</th>';
    //if ($ind == 1)
        $th .= '<th>' . tt('Инд.') . '</th>';
    $th  .= '<th>'.tt('Итог').'</th>';
    //if ($exam == 1)
        $th .= '<th>' . tt('Экзамен') . '</th>';
    $th  .= '<th>'.tt('Всего').'</th>';
    $th  .= '<th>'.tt('ECTS').'</th>';
    $th  .= '<th>'.tt('Итог(5)').'</th>';
}

foreach ($modules as $module)
{
    $marks = Jpv::model()->getMarksFromStudent($module['uo1'],$gr1,$st->st1);
    $tr.='<tr>';
    $tr.='<td>'.$module['name'].'</td>';
    $summ=0;
    for ($i=1; $i<=$maxCount;$i++)
    {
        if(!isset($module[$i]))
            $tr.='<td class="not-module">-</td>';
        else {
            $mark = isset($marks[$i]) && $marks[$i]['jpvd3'] != 0
                ? round($marks[$i]['jpvd3'], 1)
                : '';
            if($mark!='')
                $summ+=$mark;
            $tr .= '<td>'.$mark.'</td>';
        }
    }
    if($ps42==1) {
        $tr.= '<td>'.$summ.'</td>';
        $marks = Jpv::model()->getMarksFromStudentDop($module['uo1'],$gr1,$st->st1);
        $total_2 = $summ + dopMark($marks,-1);
        $total_3 = $total_2 + dopMark($marks,-2);
        //if ($ind == 1) {
            $mark = isset($marks[-1]) && $marks[-1]['jpvd3'] != 0
                ? round($marks[-1]['jpvd3'], 1)
                : '';
            $tr .= '<td>'.$mark.'</td>';

        //}
        $tr .= '<td data-total=2>'.$total_2.'</td>'; // total 2
        //if ($exam == 1) {
            $mark = isset($marks[-2]) && $marks[-2]['jpvd3'] != 0
                ? round($marks[-2]['jpvd3'], 1)
                : '';
            $tr .= '<td>'.$mark.'</td>';
        //}
        $tr .= '<td data-total=3>'.$total_3.'</td>'; // total 3
        list($ects,$bal5)= getBal($bal,$total_3);
        $tr .= '<td data-total=4>'.$ects.'</td>'; // total 4
        $tr .= '<td data-total=5>'.$bal5.'</td>'; // total 5
    }
    $tr.='</tr>';

}

echo sprintf($table,$th,$tr);

