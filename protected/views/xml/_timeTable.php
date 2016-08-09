<?php
/**
 * Created by PhpStorm.
 * User: Neff
 * Date: 09.08.2016
 * Time: 22:34
 */

$weekNumber = 0;//номер недели

$r2='';//дата занятия
$r3=0;//номер занятия

$isStart = true;//для того что бы на первой итерации закрывающие теги не писать

foreach($timeTable as $lesson){
    //проверем изменилась ли дата если да то выводим закрывающий тег для day
    if($r2!=$lesson['r2']){
        if(!$isStart){
            echo '</day>';
        }
    }

    //проверем изменилась ли неделя если да то выводим тег для недели
    if($weekNumber!=$lesson['ned']){
        if(!$isStart){
            echo '</week>';
        }
        $weekNumber=$lesson['ned'];
        echo sprintf('<week number="%d">', $weekNumber);
    }

    //проверем изменилась ли дата если да то выводим тег для day
    if($r2!=$lesson['r2']){
        $r2=$lesson['r2'];
        echo sprintf('<day date="%s">', date(XmlController::FORMAT_DATE, strtotime($r2)));
    }

    //if($r3!=$lesson['r3']){
        /*if(!$isStart){
            echo '</lesson>';
        }*/
        $r3=$lesson['r3'];
        echo sprintf('<lesson number="%d">', $r3);
        echo '</lesson>';
    //}


    $isStart = false;
}

if(!$isStart){
            //echo '</lesson>';
        echo '</day>';
    echo '</week>';
}

