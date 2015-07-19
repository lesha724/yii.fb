<?php
function getTh($val)
{
    if($val>0)
    {
        return '<span data-toggle="tooltip" data-placement="top" data-original-title="'.tt('Пересдача').' '.$val.'">'.tt('П').' '.$val.'</span>';
        //return tt('П').' '.$val;
    }
    else
    {
        return tt('Тест');
    }
}
function generateColumnName($i)
{
    $pattern = <<<HTML
	<th colspan="4"><span class="green">%s</span></th>
HTML;
    $name = tt('Тест').' №'.$i;

    return sprintf($pattern, $name);
}

$table = <<<HTML
<div class="journal_div_table2">
    <table class="table table-striped table-bordered table-hover journal_table">
        <thead>
            <tr>
                %s
            </tr>
            <tr class="per-name">

                %s
            </tr>
        </thead>
        <tbody>
            %s
        </tbody>
    </table>
</div>
HTML;
    
    $max = Test::model()->getMaxTest();
    $th_head='<th>'.  getTh(0).'</th>
        <th>'.  getTh(1).'</th>
        <th>'.  getTh(2).'</th>
        <th>'.  getTh(3).'</th>';
    
    $pattern = <<<HTML
<td>%s</td><td>%s</td><td>%s</td><td>%s</td>
HTML;
    
    /*** 2 table ***/
    $th = $th2 = $tr = '';
    $column = 1;
    for ($i = 1; $i <= $max; $i++) {
        $th    .= generateColumnName($i);
        $th2   .= $th_head;
    }
    
    foreach($disciplines as $disp) {
        $tr .='<tr>';
        for ($i = 1; $i <= $max; $i++) {
            $val=  Test::model()->getValueByDispNumber($disp['test2'],$i);
            if($val!=null)
            {
                $tr .= sprintf($pattern, $val->test6, $val->test7, $val->test8, $val->test9);
            }
            else
            {
                $tr .= sprintf($pattern,  '', '', '', '');
            }
        }
        $tr .='</tr>';
    }

    echo sprintf($table, $th, $th2, $tr); // 2 table


