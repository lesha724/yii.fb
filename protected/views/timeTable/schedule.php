<?php

function countHeight($maxLessons, $dayOfWeek, $lesson)
{
    $height = isset($maxLessons[$dayOfWeek][$lesson])
                ? 50*$maxLessons[$dayOfWeek][$lesson]
                : 50;

    return $height;
}

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
        $h = countHeight($maxLessons, $dayOfWeek, $lesson);
        $html .= <<<HTML
<div class="lh-{$h} mh-{$h} cell tooltip-info" data-rel="tooltip" data-placement="left" data-original-title="{$interval}">{$lesson}</div>
HTML;

    }
    $html .= '</td>';

    // колонки с занятиями
    $firstTs = $timestamps[0];
    for($week = 0; $week < $amountOfWeeks; $week++) {

        $day  = $firstTs + $week*7*86400; // timestamp of current day
        $tt   = $timeTable[$day]['timeTable'];

        $date = $timeTable[$day]['date'];

        $isClosed = $day < strtotime($model->date1) ||
                    $day > strtotime($model->date2);
        $closedClass = $isClosed ? 'class="closed"' : null;

        $html .= '<td '.$closedClass.'>
                    <div>'.$date.'</div>';

        foreach (range($min, $max) as $lesson) {

            $mh = countHeight($maxLessons, $dayOfWeek, $lesson);

            $shortText = $fullText = $params = '';
            if (isset($tt[$lesson])) {
                $shortText = $tt[$lesson]['shortText'];
                $fullText  = trim($tt[$lesson]['fullText'], '<br>');
            }

            $html .= <<<HTML
<div class="cell mh-{$mh}"  data-rel="popover" data-placement="right" data-content="{$fullText}">{$shortText}</div>
HTML;

        }

        $html .= '</td>';
    }

    array_shift($timestamps);

    $html .= '</tr>';
}
$html .= '</table>';

echo $html;

