<?php
function getTh3($val)
{
    if($val>0)
    {
        //return tt('П');
        return '<span data-toggle="tooltip" data-placement="top" data-original-title="'.tt('Пересдача').'">'.tt('П').'</span>';
        
    }
    else
    {
        return tt('Тест');
    }
}
    /*$pattern = <<<HTML
<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>
HTML;*/
    $pattern = <<<HTML
<tr><td>%s</td><td>%s</td></tr>
HTML;
    /*$th='<th>'.  getTh3(0).'</th>
        <th>'. getTh3(1).'</th>
        <th>'.  getTh3(2).'</th>
        <th>'.  getTh3(3).'</th>';*/
    $th='<th>'.  getTh3(0).'</th>
        <th>'. getTh3(1).'</th>';
    
    $columnName = tt('Итого');
    $table = <<<HTML
<div class="journal_div_table3">
<table class="table table-striped table-bordered table-hover journal_table" >
    <thead>
        <tr>
            <th colspan="4">{$columnName}</th>
        </tr>
        <tr class="per-name">
            {$th}
        </tr>
    </thead>
    <tbody>
        %s
    </tbody>
</table>
</div>
HTML;

    /*** 1 table ***/
    $tr = '';
    $key=0;
    foreach($disciplines as $disp) {
        $key++;
        $val=  Test::model()->getValueByDisp($disp['test2']);
        /*if($val!=null)
        {
            $tr .= sprintf($pattern,  $val->test6, $val->test7, $val->test8, $val->test9);
        }
        else
        {
            $tr .= sprintf($pattern,  '', '', '', '');
        }*/
        if($val!=null)
        {
            $tr .= sprintf($pattern,  $val->test6, $val->test7);
        }
        else
        {
            $tr .= sprintf($pattern,  '', '');
        }
        
    }
    echo sprintf($table, $tr); // 1 table