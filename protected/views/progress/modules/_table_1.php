<?php
    $pattern = <<<HTML
<tr data-st1="%s"><td class="center">%s</td><td>%s</td></tr>
HTML;

    $columnName = tt('ФИО');
    $table = <<<HTML
<table class="table table-striped table-bordered table-hover journal_table journal_table_1" >
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
    foreach($students as $key => $st) {
        $name = ShortCodes::getShortName($st['st2'], $st['st3'], $st['st4']);
        $name = mb_substr($name, 0, 10);
        $num  = $key+1;

        $tr .= sprintf($pattern, $st['st1'], $num, $name);
    }
    echo sprintf($table, $tr); // 1 table