<?php
    $pattern = <<<HTML
<tr><td class="center">%s</td><td><label data-toggle="tooltip" data-placement="right" title="" data-original-title="%s">%s</label></td></tr>
HTML;

    $columnName = tt('Преподаватель');
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
    foreach($teachers as $teacher) {
        $key++;
        $name=$teacher['name'];
        $len=strlen(utf8_decode($name));
        if($len>15)
        {
            $name=mb_substr($teacher['name'], 0, 15,'UTF-8')."...";
        }
        $tr .= sprintf($pattern, $key, $teacher['name'],$name);
    }
    echo sprintf($table, $tr); // 1 table

