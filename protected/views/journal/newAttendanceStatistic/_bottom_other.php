<?php
/**
 * Created by PhpStorm.
 * User: neffa
 * Date: 03.05.2018
 * Time: 16:02
 */

/** @var $model AttendanceStatisticForm */
/** @var $this JournalController */

$students = $model->getStudents();
list($firstDay, $lastDay) = Sem::model()->getSemesterStartAndEnd($model->semester);

$th = $tr = '';
//заголовок для таблицы с пз
$th.='<tr>';
$th.='<th>'.tt('№ пп').'</th>';
$th.='<th>'.tt('Количество прошедших занятий').'</th>';
$th.='<th>'.tt('Количество пропусков').'</th>';
$th.='<th>'.tt('Количество уваж. пропусков').'</th>';
$th.='</tr>';

foreach ($students as $student){

    list($respectful,$disrespectful,$count) = Elg::model()->getAttendanceStatisticInfoByDate($firstDay, $lastDay, $student['st1']);
}