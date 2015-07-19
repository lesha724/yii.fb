<?php
    $pattern = <<<HTML
<tr><td class="center">%s</td><td>%s</td></tr>
HTML;

    $columnName = tt('Дисциплина');
    $table = <<<HTML
<table class="table table-striped table-bordered table-hover journal_table journal_table_1 small-table-1" >
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
        $tr .= sprintf($pattern, $key, $disp['d2']);
    }
    echo sprintf($table, $tr); // 1 table