<?php
function table2Tr($module,$st,$marks)
{
    $key = $module['jpv4'];
    $mark = isset($marks[$key]) && $marks[$key]['jpvd3'] != 0
        ? round($marks[$key]['jpvd3'], 1)
        : '';
    if(empty($module['jpvp2']))
    {
        $pattern= <<<HTML
        <td>
            <input disabled="disabled" value="%s" maxlength="3"/>
        </td>
HTML;
        return sprintf($pattern,$mark);
    }else
    {
        $pattern= <<<HTML
        <td data-jpv1="%s">
            <input value="%s" maxlength="3"/>
        </td>
HTML;
        return sprintf($pattern,$module['jpv1'],$mark);
    }
}
function generateColumnName($module)
{
    $pattern = <<<HTML
	<th>
        <span class="%s">%s</span>
    </th>
HTML;

    $class='green';
    $name =tt('№').$module['jpv4'];
    if(empty($module['jpvp2']))
    {
        //$name.='('.tt('Просмотр').')';
        $class='red';
    }

    return sprintf($pattern,$class,$name);
}

function countMarkTotal($marks)
{
    $total = 0;
    foreach ($marks as $mark) {
        $total += $mark['jpvd3'] != 0
            ? $mark['jpvd3']
            : 0;
    }
    return $total;
}


    $url = Yii::app()->createUrl('progress/insertJpvd');

    $table = <<<HTML
<div class="modules_div_table2" data-gr1="{$gr1}" data-url="{$url}">
    <table class="table table-striped table-bordered table-hover modules_table modules_table_2">
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




    $th  = $tr = '';

    global $total_1;
    global $count_modules;
    $count_modules=0;

    foreach($modules as $module) {
        $th .= generateColumnName($module);
        $count_modules++;
    }

    foreach($students as $st) {
        $st1 = $st['st1'];
        $tr .= '<tr data-st1="'.$st1.'">';
        $marks = Jpv::model()->getMarksFromStudent($uo1,$gr1,$st1);
        $total_1[$st1] = countMarkTotal($marks);
        foreach($modules as $key => $module) {
            $tr .= table2Tr($module,$st,$marks);
        }
        $tr .= '</tr>';
    }

    echo sprintf($table, $th, $tr); // 2 table


