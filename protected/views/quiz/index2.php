<?php
/**
 * Created by PhpStorm.
 * User: neffa
 * Date: 16.11.2018
 * Time: 17:54
 */

/**
 * @var QuizController $this
 * @var TimeTableForm $model
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


if (! empty($model->group))
    $this->renderPartial('index/_bottom', array(
        'model' => $model
    ));