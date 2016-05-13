<?php
/**
 * Created by PhpStorm.
 * User: Neff
 * Date: 27.11.2015
 * Time: 11:23
 */

list($modules,$min,$max) = Vvmp::model()->getModuleBySt($st->st1);

$table =<<<HTML
    <table class="table table-condensed table-hover">
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
for ($i=$min; $i<=$max;$i++)
{
    $th.='<th>'.tt('Модуль №').$i.'</th>';
}

//print_r($modules);
foreach ($modules as $module)
{
    //$marks = Vmp::model()->getMarksFromStudent($module['uo1'],$gr1,$st->st1);
    $tr.='<tr>';
    $tr.='<td>'.$module['discipline'].'</td>';
    $summ=0;
    for ($i=$min; $i<=$max;$i++)
    {
        if(!isset($module[$i]))
            $tr.='<td class="not-module"></td>';
        else {
            if(isset($module[$i])&&!empty($module[$i]['vmp1'])){
                $tr .= '<td>'.round($module[$i]['vmp4'],2).'</td>';
            }else{
                $tr .= '<td>-</td>';
            }


        }
    }

    $tr.='</tr>';

}

echo sprintf($table,$th,$tr);

