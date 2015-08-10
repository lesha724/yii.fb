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
<tr><td>%s</td><td>%s</td><td>%s</td></tr>
HTML;
    $pattern1 = <<<HTML
<tr><td class="empty-td">%s</td><td class="empty-td">%s</td><td>%s</td></tr>
HTML;
    /*$th='<th>'.  getTh3(0).'</th>
        <th>'. getTh3(1).'</th>
        <th>'.  getTh3(2).'</th>
        <th>'.  getTh3(3).'</th>';*/
    $th='<th>'.  getTh3(0).'</th>
        <th>'. getTh3(1).'</th>'
            . '<th></th>';
    
    $columnName = tt('Экзамен');
    $columnName1 = tt('Итог');
    $table = <<<HTML
<div class="journal_div_table3">
<table class="table table-bordered journal_table" >
    <thead>
        <tr>
            <th colspan="2">{$columnName}</th>
            <th>{$columnName1}</th>
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
        $val=  Test::model()->getValueByDispNumber($disp['test2'],0);
        $val1=  Test::model()->getValueByDispNumber($disp['test2'],-1);
        /*if($val!=null)
        {
            $tr .= sprintf($pattern,  $val->test6, $val->test7, $val->test8, $val->test9);
        }
        else
        {
            $tr .= sprintf($pattern,  '', '', '', '');
        }*/
        $itog='&nbsp;';
        if($val1!=null)
        {
            $itog= $val1->test6;
        }
        if($val!=null)
        {
            $tr .= sprintf($pattern,  $val->test6, $val->test7,$itog);
        }
        else
        {
            $tr .= sprintf($pattern1,  '&nbsp;', '&nbsp;',$itog);
        }
        
    }
    echo sprintf($table, $tr); // 1 table