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
                  <div>'.$name.'</div>';
    foreach (range($min, $max) as $lesson) {
        $interval = isset($rz[$lesson]) ? $rz[$lesson]['rz2'].' - '.$rz[$lesson]['rz3'] : null;
        $html .= <<<HTML
<div class="lh-50 cell tooltip-info" data-rel="tooltip" data-placement="left" data-original-title="{$interval}">{$lesson}</div>
HTML;

    }
    $html .= '</td>';

    // колонки с занятиями
    $firstTs = $timestamps[0];
    for($week = 0; $week < $amountOfWeeks; $week++) {

        $day  = $firstTs + $week*7*86400; // timestamp of current day
        $tt   = $timeTable[$day]['timeTable'];

        $date = $timeTable[$day]['date'];

        $closedClass = $day < strtotime($model->date1) || $day > strtotime($model->date2)
                           ? 'class="closed"'
                           : '';

        $html .= '<td '.$closedClass.'>
                    <div>'.$date.'</div>';

        foreach (range($min, $max) as $lesson) {

            $shortText = $fullText = $color = $r11 = '';
            if (isset($tt[$lesson])) {
                $shortText = $tt[$lesson]['shortText'];
                $fullText  = $tt[$lesson]['fullText'];
                $color     = SH::getLessonColor($tt[$lesson]['tip']);
                $r11       = $tt[$lesson]['r11'];
            }
            // индикация изменений
            $indicated = !empty($r11) &&
                         strtotime('today -'.$model->r11.' days') <= strtotime($r11);
            if ($indicated)
                $color = TimeTableForm::r11Color;

            $html .= <<<HTML
<div class="cell" style="background:{$color}" data-rel="popover" data-placement="right" data-content="{$fullText}">{$shortText}</div>
HTML;

        }

        $html .= '</td>';

    }
    array_shift($timestamps);

    $html .= '</tr>';
}
$html .= '</table>';

echo $html;

