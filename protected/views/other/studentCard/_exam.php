<?php
/**
 * Created by PhpStorm.
 * User: Neff
 * Date: 30.12.2015
 * Time: 10:04
 */

$disciplines  = St::model()->getDisciplineExam($st->st1,$gr1);

if(empty($disciplines))
    echo '<div class="">'.tt('Нет дисциплин').'</div>';
else{

    $pattern = <<<HTML
        <table class = "table table-bordered table-hover table-condensed">
            <thead>
                %s
            </thead>
            <tbody>
                %s
            </tbody>
</table>
HTML;

    $tr = $tr2 = "";
    $tr.='<tr>';
    $tr.='<th>'.tt('№ пп').'</th>';
    $tr.='<th>'.tt('Дисциплина').'</th>';
    $tr.='<th>'.tt('Тип').'</th>';
    $tr.='<th>'.tt('№ ведомости').'</th>';
    $tr.='<th>'.tt('Дата ведомости').'</th>';
    $tr.='<th>'.tt('5-ная').'</th>';
    $tr.='<th>'.tt('ECTS').'</th>';
    $tr.='<th>'.tt('Др. бальность').'</th>';
    $tr.='</tr>';

    $i=1;
    foreach($disciplines as $discipline)
    {
        $tr2.='<tr>';
        $tr2.='<td>'.$i.'</td>';
        $tr2.='<td>'.$discipline['d2'].'</td>';
        $type=$discipline['stus19'];
        $tr2.='<td>'.SH::convertUS4($type).'</td>';
        $tr2.='<td>'.$discipline['stus7'].'</td>';
        $tr2.='<td>'.date('Y-m-d',strtotime($discipline['stus6'])).'</td>';
        if($type!=6)
            $tr2.='<td>'.$discipline['stus8'].'</td>';
        else
        {
            if($discipline['stus8']==-1)
                $val = tt('зачет.');
            else
                $val = tt('незач.');
            $tr2.='<td>'.$val.'</td>';
        }
        $tr2.='<td>'.$discipline['stus11'].'</td>';
        $tr2.='<td>'.$discipline['stus3'].'</td>';
        $tr2.='</tr>';
        $i++;
    }

    echo sprintf($pattern,$tr,$tr2);
}