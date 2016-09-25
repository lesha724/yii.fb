<?php
/**
 * Created by PhpStorm.
 * User: Neff
 * Date: 09.08.2016
 * Time: 22:34
 */
/*студенті и преподователи*/
$weekNumber = 0;//номер недели

$r2='';//дата занятия
$r3=0;//номер занятия

$isStart = true;//для того что бы на первой итерации закрывающие теги не писать

foreach($timeTable as $key=> $day) {
    foreach ($day['timeTable'] as $key => $lesson) {
        //проверем изменилась ли дата если да то выводим закрывающий тег для day
        if ($r2 != $lesson['r2']) {
            if (!$isStart) {
                echo '</Day>';
            }
        }

        //проверем изменилась ли неделя если да то выводим тег для недели
        if ($weekNumber != $lesson['ned']) {
            if (!$isStart) {
                echo '</Week>';
            }
            $weekNumber = $lesson['ned'];
            echo sprintf('<Week number="%d">', $weekNumber);
        }

        //проверем изменилась ли дата если да то выводим тег для day
        if ($r2 != $lesson['r2']) {
            $r2 = $lesson['r2'];
            echo sprintf('<Day date="%s">', date(XmlController::FORMAT_DATE, strtotime($r2)));
        }

        $r3 = $lesson['r3'];
        echo sprintf('<Lesson number="%d">', $r3);
        //*Название*/
        echo '<LessonName attr="',$lesson['d3'],'">', $lesson['d2'], '</LessonName>';
        /*Время начала*/
        echo '<TimeStart>', $lesson['rz2'], '</TimeStart>';
        /*Время окончаня*/
        echo '<TimeFinish>', $lesson['rz3'], '</TimeFinish>';
        /*Аудитория номер ( или нужен айди)*/
        if ($type != XmlController::VIEW_AUDIENCE)
            echo '<Audience name="' . $lesson['a2'] . '">', $lesson['a1'], '</Audience>';

        if ($type != XmlController::VIEW_TEACHER) {
            /*преподователи*/
            $teachers = explode(',', $lesson['p1_list']);
            echo '<Teachers>';
            foreach ($teachers as $teacher) {
                if (!empty($teacher)) {
                    $teacherParam = explode('-', $teacher);
                    $teacherModel = P::model()->findByPk($teacherParam[0]);
                    if(!empty($teacherModel)) {
                        echo '<Teacher id="' . $teacherModel->p1 . '" firstName="' . $teacherModel->p4 . '" secondName="' . $teacherModel->p5 . '" lastName="' . $teacherModel->p3 . '">', $teacherParam[1], '</Teacher>';
                    }else{
                        echo '<Teacher id="' . $teacherParam[0] . '" firstName="" secondName="" lastName="">', $teacherParam[1], '</Teacher>';
                    }
                }
            }
            echo '</Teachers>';
        }
        /*Тип занятия*/
        echo '<Type>', $lesson['us4'], '</Type>';

        if ($type != XmlController::VIEW_GROUP) {
            echo '<Groups>';
            /*Группа*/
            foreach($lesson['gr'] as $key=>$group) {
                echo '<Group type="' . $group . '">', $key, '</Group>';
            }
            echo '</Groups>';
        }
        /*Стандарное время или нет*/
        $pos = stripos($lesson['d3'], "(!)");
        echo '<StandartTime>', ($pos !== false) ? 1 : 0, '</StandartTime>';

        echo '</Lesson>';


        $isStart = false;
    }
}

if(!$isStart){
            //echo '</lesson>';
        echo '</Day>';
    echo '</Week>';
}

