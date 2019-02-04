<?php
/**
 * Created by PhpStorm.
 * User: neffa
 * Date: 04.02.2019
 * Time: 13:22
 */

/**
 * @var St $student
 */

echo CHtml::tag('h3', array(), tt('Дисциплины'));
$this->renderPartial('student/_table1', array(
    'student' => $student
));

echo CHtml::tag('h3', array(), tt('Документы подтверждающие в научно-иследовательской деятельности'));
$this->renderPartial('student/_table2', array(
    'student' => $student
));

echo CHtml::tag('h3', array(), tt('Документы подтверждающие участие в общественной деятельности'));
$this->renderPartial('student/_table3', array(
    'student' => $student
));