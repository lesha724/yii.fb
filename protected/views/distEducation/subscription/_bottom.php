<?php
/**
 * Created by PhpStorm.
 * User: NEFF
 * Date: 12.01.2018
 * Time: 15:54
 */

/* @var $this DistEducationController */
/* @var $model DistEducationFilterForm */

$buttons = CHtml::link('<i class="icon-ok"></i>', array('subscriptionDisp', 'uo1'=> $model->discipline, 'chairId'=> $model->chairId, 'subscription'=>1), array(
        'class'=>'btn btn-warning btn-mini btn-subscript-disp'
    )).CHtml::link('<i class="icon-trash"></i>', array('subscriptionDisp', 'uo1'=> $model->discipline, 'chairId'=> $model->chairId, 'subscription'=>0), array(
        'class'=>'btn btn-danger btn-mini btn-unsubscript-disp'
    ));

$table = <<<HTML
        <div>
            {$buttons}
        </div>
        <table class="table table-bordered table-condensed table-hover">
            <thead>
               %s     
            </thead>
            <tbody>
                %s
            </tbody>
        </table> 
HTML;

$thead = <<<HTML
    <tr>
        <th>№</th>
        <th>Группа</th>
        <th>Запись группы</th>
        <th>Перенос оценок</th>
        <th>Просмотр группы</th>
    </tr>
HTML;

$tbody = '';

$groups = $model->getGroupsByUo1($model->discipline);
$i=1;
foreach ($groups as $group){
    $name = Gr::model()->getGroupName($group['sem4'], $group);

    $button = CHtml::link('<i class="icon-ok"></i>', array('subscriptionGroup', 'gr1'=>$group['gr1'], 'uo1'=> $model->discipline, 'chairId'=> $model->chairId, 'subscription'=>1), array(
        'class'=>'btn btn-warning btn-mini btn-subscript-group'
    )).CHtml::link('<i class="icon-trash"></i>', array('subscriptionGroup', 'gr1'=>$group['gr1'], 'uo1'=> $model->discipline, 'chairId'=> $model->chairId, 'subscription'=>0), array(
            'class'=>'btn btn-danger btn-mini btn-unsubscript-group'
    ));

    $buttonUpload = CHtml::link('<i class="icon-ok"></i>', array('uploadMarks', 'gr1'=>$group['gr1'], 'uo1'=> $model->discipline, 'chairId'=> $model->chairId), array(
        'class'=>'btn btn-warning btn-mini btn-upload-marks'
    ));

    $buttonGroups = CHtml::link('<i class="icon-eye-open"></i>', array('showGroup', 'gr1'=>$group['gr1'], 'uo1'=> $model->discipline, 'chairId'=> $model->chairId), array(
        'class'=>'btn btn-primary btn-mini btn-show-group'
    ));

    $tbody.=sprintf('<tr><td>%d</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>', $i, $name, $button, $buttonUpload, $buttonGroups);
    $i++;
}

echo sprintf($table,$thead, $tbody);
