<?php

/**
 * @var St[] $students
 */

$pattern = <<<HTML
<tr><td class="center">%s</td><td>%s</td></tr>
HTML;

$columnName = tt('ФИО');
$table = <<<HTML
<table class="table table-striped table-bordered table-hover small-rows small-table-1" >
    <thead>
        <tr style="height: 61px">
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
    $name = $st->fullName;
	$name = '<a href="#" class="student-statistic" data-st1="'.$st->st1.'">'.mb_strimwidth($name, 0, 15, '...').'</a>';
    $num  = $key+1;

    $tr .= sprintf($pattern, $num, $name);
}
echo sprintf($table, $tr); // 1 table