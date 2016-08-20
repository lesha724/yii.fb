<?php
    $pattern = <<<HTML
<tr><td class="center">%s</td><td>%s</td></tr>
HTML;

    $columnName = tt('Группа');
    $table = <<<HTML
<table class="table table-bordered small-table-1 time-table-chair-1" >
    <thead>
        <tr rowspan="2">
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
    foreach($groups as $group) {
        $key++;
        $name=$group['name'];
        $tr .= sprintf($pattern, $key, $name);
    }
    echo sprintf($table, $tr); // 1 table

