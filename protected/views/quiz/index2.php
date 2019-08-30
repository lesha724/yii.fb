<?php
/**
 * Created by PhpStorm.
 * User: neffa
 * Date: 16.11.2018
 * Time: 17:54
 */

/**
 * @var QuizController $this
 * @var St $st
 */
$this->pageHeader=tt('Опрос');
$this->breadcrumbs=array(
    tt('Опрос'),
);

Yii::app()->clientScript->registerPackage('gritter');
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/quiz/main2.js', CClientScript::POS_HEAD);

echo <<<HTML
    <span id="spinner1"></span>
HTML;

$this->renderPartial('index2/_index', array(
    'st' => $st
));