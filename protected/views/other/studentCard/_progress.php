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

$tableFilter = <<<HTML
    <table id="studentCardProgressFilter" class="table table-bordered table-striped table-condensed">
        <thead>
                %s
        </thead>
        <tbody>
            %s
        </tbody>
    </table>
HTML;

$th = $tr = '';
$th.='<tr class="head-row">';
$th.='<th rowspan="2">'.tt('№ пп').'</th>';
$th.='<th rowspan="2">'.tt('Дисциплина').'</th>';
$th.='<th rowspan="2">'.tt('№ сем.').'</th>';
$th.='<th rowspan="2">'.tt('Тип').'</th>';
$th.='<th colspan="3">'.tt('Оценка').'</th>';
$th.='<th rowspan="2">'.tt('№ ведом.').'</th>';
$th.='<th rowspan="2">'.tt('Дата').'</th>';
$th.='</tr>';
$th.='<tr class="head-row" >';
$th.='<th>5</th>';
$th.='<th>'.tt('ECTS').'</th>';
$th.='<th>100</th>';
$th.='</tr>';

$i=1;

$tableSem = array();

$tableMark = array();
$tableMark[5]=0;
$tableMark[4]=0;
$tableMark[3]=0;
$tableMark[2]=0;
$tableMark[0]=0;
$tableMark[tt('зарах.')]=0;
$tableMark[tt('не зарах.')]=0;

foreach ($marks as $mark) {
    /*фильтры*/
    $sem = (int)$mark['stus20'];
    if(isset($tableSem[$sem]))
        $tableSem[$sem]++;
    else
        $tableSem[$sem]=1;


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

    if(isset($tableMark[$stus8]))
        $tableMark[$stus8]++;
    /*else
        $tableMark[$stus8]=1;*/

    /*таблица с оценками*/
    $tr .= '<tr data-mark="'.$stus8.'" data-sem="'.$mark['stus20'].'">';

    $tr .= '<td>'.$i.'</td>';
    if(!empty($mark['d27'])&&Yii::app()->language=="en")
        $d2=$mark['d27'];
    else
        $d2=$mark['d2'];
    $tr.='<td class="text-left">'.$d2.'</td>';

    $tr.='<td>'.$mark['stus20'].'</td>';
    $tr.='<td style="background-color: '.SH::getColorByStus19($mark['stus19']).';">'.SH::convertStus19($mark['stus19']).'</td>';

    $tr.='<td>'.$stus8.'</td>';
    $tr.='<td>'.$mark['stus11'].'</td>';
    $tr.='<td>'.$mark['stus3'].'</td>';

    $tr.='<td>'.$mark['stus7'].'</td>';
    $date = $mark['stus6'];
    if(!empty($date))
        $date = date('d.m.Y',strtotime($mark['stus6']));
    $tr.='<td>'.$date.'</td>';

    $tr .= '</tr>';
    $i++;
}

$thFilter = $trFilter = '';


    $all=0;

    $thFilter.='<th>'.tt('Оценка').'</th>';
    $trFilter.='<th>'.tt('Количетсво').'</th>';
    foreach($tableMark as $key=>$mark){
        $thFilter.='<td>'.$key.'</td>';
        $trFilter.='<td class="filter filter-mark" data-mark="'.$key.'"><a>'.$mark.'</a></td>';
        $all+=$mark;
    }

    $thFilter='<th>'.tt('Всего').'</th>'.$thFilter;
    $trFilter='<td class="show-all"><a class="badge badge-success">'.$all.'</a></td>'.$trFilter;

    $thFilter.='<th>'.tt('Семестр').'</th>';
    $trFilter.='<th>'.tt('Количетсво').'</th>';
    foreach($tableSem as $key=>$sem){
        $thFilter.='<td>'.$key.'</td>';
        $trFilter.='<td class="filter filter-sem" data-sem="'.$key.'"><a>'.$sem.'</a></td>';
    }

$thFilter='<tr>'.$thFilter;
$trFilter='<tr>'.$trFilter;

$thFilter.='</tr>';
$trFilter.='</tr>';

echo sprintf($tableFilter,$thFilter,$trFilter);

echo sprintf($table,$th,$tr);