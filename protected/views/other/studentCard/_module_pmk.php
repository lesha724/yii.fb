<?php
/**
 * Created by PhpStorm.
 * User: Neff
 * Date: 27.11.2015
 * Time: 11:23
 */

list($modules,$maxCount) = Vvmp::model()->getModuleBySt($st->st1);

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


foreach ($modules as $module)
{
    //$marks = Vmp::model()->getMarksFromStudent($module['uo1'],$gr1,$st->st1);
    $tr.='<tr>';
    $tr.='<td>'.$module['discipline'].'</td>';
    $summ=0;
    for ($i=1; $i<=$maxCount;$i++)
    {
        if(!isset($module[$i]))
            $tr.='<td class="not-module">-</td>';
        else {
            if(isset($module['discipline'][$i])&&!empty($module['discipline'][$i]['vmpv1'])){
                $tr .= '<td>+</td>';
            }else{
                $tr .= '<td>+-</td>';
            }


        }
    }

    $tr.='</tr>';

}

echo sprintf($table,$th,$tr);

