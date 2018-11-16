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

Yii::app()->clientScript->registerPackage('dataTables');
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/quiz/main.js', CClientScript::POS_HEAD);

$this->renderPartial('/filter_form/timeTable/student', array(
    'model' => $model,
    'showDateRangePicker' => false
));


echo <<<HTML
    <span id="spinner1"></span>
HTML;


if (! empty($model->student))
    $this->renderPartial('_bottom', array(
        'model' => $model
    ));