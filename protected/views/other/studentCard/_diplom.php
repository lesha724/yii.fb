<?php
/**
 * Created by PhpStorm.
 * User: Neff
 * Date: 30.12.2015
 * Time: 10:04
 */

$disp = Stus::model()->getDispByStudentCard($st->st1,$gr1,0);

$disp1 = Stus::model()->getDispByStudentCard($st->st1,$gr1,1);

$per92 = Per::model()->findByPk(92);
$table = <<<HTML
    <table id="studentCardDiplom" class="table table-bordered table-hover table-condensed">
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
$th.='<th>'.tt('№ пп').'</th>';
$th.='<th>'.tt('Дисциплина').'</th>';
$th.='<th>'.tt('Часы').'</th>';
$th.='<th>'.tt('Кредит').'</th>';
$th.='</tr>';
$i=1;
foreach($disp as $discipline)
{
    $tr.='<tr class="success">';
    $tr.='<td>'.$i.'</td>';
    $d2=$discipline['d2'];
    $tr.='<td class="text-left">'.$d2.'</td>';
    if($per92->per3==1)
    {
        $chasi = Us::model()->getSummForStudentCard($discipline['uo1'],0);
        $credit = Us::model()->getSummForStudentCard($discipline['uo1'],15);
    }else {
        $chasi = $discipline['uo12'];
        $credit = round($discipline['uo10'], 2);
    }
    $aud =  Us::model()->getSummForStudentCard($discipline['uo1'],'1,2,3,4,9,10,11,12');
    $tr .= '<td>' . round($chasi,2) . '</td>';
    $tr .= '<td>' .  round($credit,2) . '</td>';
    $tr.='</tr>';
    $i++;
}

/*foreach($disp1 as $discipline)
{
    $tr.='<tr class="info">';
    $tr.='<td>'.$i.'</td>';
    $d2=$discipline['d2'];
    $tr.='<td class="text-left">'.$d2.'</td>';
    $tr.='<td class>'.$discipline['uo12'].'</td>';
    $tr.='<td>'.round($discipline['uo10'],2).'</td>';
    $tr.='</tr>';
    $i++;
}*/
echo sprintf($table,$th,$tr);
