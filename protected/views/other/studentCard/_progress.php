<?php
/**
 * Created by PhpStorm.
 * User: Neff
 * Date: 22.06.2016
 * Time: 18:40
 */

$marks = Stus::model()->getMarksForStudent($st->st1);
$table = <<<HTML
    <table id="studentCardProgress" class="table table-bordered table-striped table-hover table-condensed">
        <thead>
                %s
        </thead>
        <tbody>
            %s
        </tbody>
    </table>
HTML;

$th = $tr = '';
$th.='<tr>';
$th.='<th rowspan="2">'.tt('№ пп').'</th>';
$th.='<th rowspan="2">'.tt('Дисциплина').'</th>';
$th.='<th rowspan="2">'.tt('№ сем.').'</th>';
$th.='<th rowspan="2">'.tt('Тип').'</th>';
$th.='<th colspan="3">'.tt('Оценка').'</th>';
$th.='<th rowspan="2">'.tt('№ ведом.').'</th>';
$th.='<th rowspan="2">'.tt('Дата').'</th>';
$th.='</tr>';
$th.='<tr>';
$th.='<th>'.tt('5').'</th>';
$th.='<th>'.tt('ECTS').'</th>';
$th.='<th>'.tt('100').'</th>';
$th.='</tr>';

$i=1;
foreach ($marks as $mark) {
    $tr .= '<tr>';

    $tr .= '<td>'.$i.'</td>';
    if(!empty($mark['d27'])&&Yii::app()->language=="en")
        $d2=$mark['d27'];
    else
        $d2=$mark['d2'];
    $tr.='<td class="text-left">'.$d2.'</td>';

    $tr.='<td>'.$mark['stus20'].'</td>';
    $tr.='<td style="background-color: '.SH::getColorByStus19($mark['stus19']).';">'.SH::convertStus19($mark['stus19']).'</td>';

    if($mark['stus19']!=6)
        $stus8 = $mark['stus8'];
    else
    {
        if($mark['stus8']!=-1){
            $stus8 = tt('не зарах.');
        }else{
            $stus8 = tt('зарах.');
        }
    }

    $tr.='<td>'.$stus8.'</td>';
    $tr.='<td>'.$mark['stus11'].'</td>';
    $tr.='<td>'.$mark['stus3'].'</td>';

    $tr.='<td>'.$mark['stus7'].'</td>';
    $tr.='<td>'.$mark['stus6'].'</td>';

    $tr .= '</tr>';
    $i++;
}
echo sprintf($table,$th,$tr);