<?php
/**
 * Created by PhpStorm.
 * User: neffa
 * Date: 03.05.2018
 * Time: 16:28
 */

/** @var $model AttendanceStatisticForm */
/** @var $this JournalController */

$form=$this->beginWidget('CActiveForm', array(
    'action' => $this->createUrl('/journal/newAttendanceStatistic'),
    'method' => 'get',
    'htmlOptions' => array('class' => 'form-inline')
));
echo CHtml::radioButtonList('type', $model->scenario, AttendanceStatisticForm::scenarios(),array( 'separator' => ' ' ));

$this->endWidget();
