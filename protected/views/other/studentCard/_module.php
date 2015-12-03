<?php
/**
 * Created by PhpStorm.
 * User: Neff
 * Date: 27.11.2015
 * Time: 11:23
 */
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
    if ($ind == 1)
        $th .= '<th>' . tt('Инд.') . '</th>';
    if ($exam == 1)
        $th .= '<th>' . tt('Экзамен') . '</th>';
}

foreach ($modules as $module)
{
    $marks = Jpv::model()->getMarksFromStudent($module['uo1'],$gr1,$st->st1);
    $tr.='<tr>';
    $tr.='<td>'.$module['name'].'</td>';
    for ($i=1; $i<=$maxCount;$i++)
    {
        if(!isset($module[$i]))
            $tr.='<td>-</td>';
        else {
            $mark = isset($marks[$i]) && $marks[$i]['jpvd3'] != 0
                ? round($marks[$i]['jpvd3'], 1)
                : '';
            $tr .= '<td>'.$mark.'</td>';
        }
    }
    if($ps42==1) {
        $marks = Jpv::model()->getMarksFromStudentDop($module['uo1'],$gr1,$st->st1);
        if ($ind == 1) {
            $mark = isset($marks[-1]) && $marks[-1]['jpvd3'] != 0
                ? round($marks[-1]['jpvd3'], 1)
                : '';
            $tr .= '<td>'.$mark.'</td>';

        }
        if ($exam == 1) {
            $mark = isset($marks[-2]) && $marks[-2]['jpvd3'] != 0
                ? round($marks[-2]['jpvd3'], 1)
                : '';
            $tr .= '<td>'.$mark.'</td>';
        }
    }
    $tr.='</tr>';

}

echo sprintf($table,$th,$tr);

