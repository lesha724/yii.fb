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

$table = <<<HTML
    <table id="newAttendanceStatistic-table"  class="table table-bordered table-hover table-condensed">
        <thead>
                %s
        </thead>
        <tbody>
            %s
        </tbody>
    </table>
HTML;

$th = $tr = '';
//заголовок для таблицы с пз
$th.='<tr>';
$th.='<th>'.tt('№ пп').'</th>';
$th.='<th>'.tt('Студент').'</th>';
$th.='<th>'.tt('Группа').'</th>';
$th.='<th>'.tt('Количество прошедших занятий').'</th>';
$th.='<th>'.tt('Количество уваж. пропусков').'</th>';
$th.='<th>'.tt('Количество неуваж. пропусков').'</th>';
$th.='</tr>';

$i = 1;

$groupName = '';
if($model->scenario == AttendanceStatisticForm::SCENARIO_GROUP){
    $_group = Gr::model()->findByPk($model->group);
    $groupName = Gr::model()->getGroupName($model->course, $_group);
}

foreach ($students as $student){

    $name = $student['st2'].' '.$student['st3'].' '.$student['st4'];
    $group = $model->scenario == AttendanceStatisticForm::SCENARIO_GROUP ? $groupName : Gr::model()->getGroupName($model->course, $student);
    list($respectful,$disrespectful,$count) = Elg::model()->getAttendanceStatisticInfoByDate($firstDay, $lastDay, $student['st1']);
    $tr.=<<<HTML
        <tr>
            <td>{$i}</td>
            <td>{$name}</td>
            <td>{$group}</td>
            <td>{$count}</td>
            <td>{$respectful}</td>
            <td>{$disrespectful}</td>
        </tr>
HTML;

    $i++;
}

echo sprintf($table,$th,$tr);