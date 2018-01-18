<?php
/**
 * Created by PhpStorm.
 * User: NEFF
 * Date: 12.01.2018
 * Time: 16:42
 */

/** @var array $group */

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

$tbody.=$thead;

$i=1;

$students = St::model()->getStudentsOfGroupForDistEducation($group['gr1']);
foreach ($students as $student) {

    $stDist = Stdist::model()->findByPk($student->st1);

    $button = empty($stDist) ? '' : CHtml::link('<i class="icon-ok"></i>', '#', array(
        'class'=>'btn btn-success btn-mini'
    ));
    $tbody.=sprintf('<tr class="tr-students-list-%d"><td>%d</td><td>%s</td><td>%s</td></tr>', $group['gr1'], $i, $student['name'], $button);
    $i++;
}
echo sprintf($table, $tbody);