<?php
/**
 * Created by PhpStorm.
 * User: NEFF
 * Date: 12.01.2018
 * Time: 16:42
 */

$table = <<<HTML
        <table class="table table-bordered table-condensed table-hover">
            <tbody>
                %s
            </tbody>
        </table> 
HTML;

$thead = <<<HTML
    <tr>
        <th>№</th>
        <th>Имя</th>
        <th></th>
    </tr>
HTML;

$tbody = '';

$name = Gr::model()->getGroupName($group['sem4'], $group);

$button = CHtml::link('<i class="icon-ok"></i>', '#', array(
    'class'=>'btn btn-warning btn-mini'
));
$tbody.='<tr><th colspan="2">'.$name.'</th><th>'.$button.'</th></tr>';
$tbody.=$thead;

$i=1;
$students = St::model()->getStudentsOfGroup($group['gr1']);
foreach ($students as $student) {
    $tbody.=sprintf('<tr class="tr-students-list-%d"><td>%d</td><td>%s</td><td>%s</td></tr>', $group['gr1'], $i, $student['name'], CHtml::link('<i class="icon-ok"></i>', '#', array(
        'class'=>'btn btn-success btn-mini'
    )));
    $i++;
}