<?php
    $pattern = <<<HTML
<tr><td class="center">%s</td><td><label data-toggle="tooltip" data-placement="right" title="" data-original-title="%s">%s</label></td></tr>
HTML;

    $columnName = tt('Дисциплина');
    $table = <<<HTML
<table class="table table-bordered journal_table journal_table_1 small-table-1" >
    <thead>
        <tr>
            <th class="center">№</th>
            <th>{$columnName}</th>
        </tr>
    </thead>
    <tbody>
        %s
    </tbody>
</table>
HTML;

    /*** 1 table ***/
    $tr = '';
    $key=0;
    foreach($disciplines as $disp) {
        $key++;
        $name=$disp['d2'];
        $len=strlen(utf8_decode($name));
        if($len>15)
        {
            $name=mb_substr($disp['d2'], 0, 15,'UTF-8')."...";
        }
        $tr .= sprintf($pattern, $key, $disp['d2'],$name);
    }
    echo sprintf($table, $tr); // 1 table