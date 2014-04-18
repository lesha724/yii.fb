<?php

$timestamps    = array_keys($timeTable);
$amountOfWeeks =  ceil(((current($timestamps) - end($timestamps))/86400) / -7);
reset($timestamps);

$html = '<table class="timeTable">';

foreach(range(1,7) as $dayOfWeek) {// дни недели 1-пн

    $html .= '<tr>';

    // первая колонка - название дня + пары 1-7
    $name = $minMax['names'][$dayOfWeek];
    $min  = $minMax['min'][$dayOfWeek];
    $max  = $minMax['max'][$dayOfWeek];

    $html .= '<td>
                  <div class="h-25 lh-25">'.$name.'</div>';
    foreach (range($min, $max) as $lesson) {
        $html .= '<div class="minh-50 lh-50">'.$lesson.'</div>';
    }
    $html .= '</td>';

    // колонки с занятиями
    $firstTs = $timestamps[0];
    for($week = 0; $week < $amountOfWeeks; $week++) {

        $day  = $firstTs + $week*7*86400; // timestamp of current day
        $tt   = $timeTable[$day]['timeTable'];
        $date = $timeTable[$day]['date'];

        $html .= '<td>
                    <div class="h-25 lh-25">'.$date.'</div>';

        foreach (range($min, $max) as $lesson) {

            $html .= '<div class="minh-50">';

                if (isset($tt[$lesson]))
                    $html .= $tt[$lesson]['text'];

            $html .= '</div>';
        }

        $html .= '</td>';

    }
    array_shift($timestamps);

    $html .= '</tr>';
}
$html .= '</table>';

echo $html;

