<?php
/**
 * Created by PhpStorm.
 * User: Neff
 * Date: 22.06.2016
 * Time: 18:40
 */

$marks = Stus::model()->getMarksForStudent($st->st1);

$table = <<<HTML
    <div class="table-responsive">
        <table id="studentCardProgress" class="table table-bordered table-striped table-hover table-condensed">
            <thead>
                    %s
            </thead>
            <tbody>
                %s
            </tbody>
        </table>
    </div>
HTML;

$tableFilter = <<<HTML
    <div class="row-fluid">
        <div class="span9">
            <table id="studentCardProgressFilter" class="table table-bordered table-striped table-condensed">
                <thead>
                        %s
                </thead>
                <tbody>
                    %s
                </tbody>
            </table>
        </div>
        <div class="span3">
            <table id="studentCardProgressSred" class="table table-bordered table-striped table-condensed">
                <thead>
                    %s
                </thead>
                <tbody>
                    %s
                </tbody>
            </table>
        </div>
    </div>
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

$sem = 0;

foreach ($marks as $mark) {
    /*фильтры*/

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

    $sem = (int)$mark['stus20'];

    if($mark['stus19']!=6) {
        if (!isset($tableSem[$sem])) {
            $tableSem[$sem]['count'] = 0;
            $tableSem[$sem]['value'] = 0;
            $tableSem[$sem]['5']=0;
            $tableSem[$sem]['4']=0;
            $tableSem[$sem]['3']=0;
            $tableSem[$sem]['2']=0;
            $tableSem[$sem]['0']=0;
        }

        $tableSem[$sem]['count']++;
        $tableSem[$sem]['value'] += $stus8;
        $tableSem[$sem][$stus8]++;
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

$thFilter = $trFilter = $thSred = $trSred = '';
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
    $trFilter.='<th>'.tt('Ср.бал').'</th>';
    $pattern =<<<HTML
        <td class="filter filter-sem" data-sem="%s" data-count="%s" data-mark5="%s" data-mark4="%s" data-mark3="%s" data-mark2="%s" data-mark0="%s">
            <a>%s</a>
        </td>
HTML;

    foreach($tableSem as $key=>$sem){
        $thFilter.='<td>'.$key.'</td>';
        $trFilter.=sprintf($pattern,$key,$sem['count'],$sem['5'],$sem['4'],$sem['3'],$sem['2'],$sem['0'],round($sem['value']/$sem['count'],2));
        //$trFilter.='<td class="filter filter-sem" data-sem="'.$key.'"><a>'.round($sem['value']/$sem['count'],2).'</a></td>';
    }

$thFilter='<tr>'.$thFilter;
$trFilter='<tr>'.$trFilter;

$thFilter.='</tr>';
$trFilter.='</tr>';

$thSred.='<tr>';
$trSred.='<tr>';

$thSred.='<td>5</td>';
$trSred.='<td class="mark5">0</td>';
$thSred.='<td>4</td>';
$trSred.='<td class="mark4">0</td>';
$thSred.='<td>3</td>';
$trSred.='<td class="mark3">0</td>';
$thSred.='<td>2</td>';
$trSred.='<td class="mark2">0</td>';
$thSred.='<td>0</td>';
$trSred.='<td class="mark0">0</td>';
$thSred.='<td>'.tt('Всего').'</td>';
$trSred.='<td class="count">0</td>';

$thSred.='</tr>';
$trSred.='</tr>';

echo sprintf($tableFilter,$thFilter,$trFilter,$thSred,$trSred);

//echo sprintf($tableFilter,$thFilter,$trFilter);

echo sprintf($table,$th,$tr);