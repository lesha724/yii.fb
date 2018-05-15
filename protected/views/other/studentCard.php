<?php
/**
 * Created by PhpStorm.
 * User: Neff
 * Date: 26.11.2015
 * Time: 15:31
 */


$this->pageHeader=tt('Карточка студента');
$this->breadcrumbs=array(
    tt('Другое'),
);

Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/other/studentCard.js', CClientScript::POS_HEAD);

Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/timetable/timetable.js', CClientScript::POS_HEAD);

if(Yii::app()->user->isAdmin) {
    $this->renderPartial('/filter_form/timeTable/student', array(
        'model' => $model,
        'showDateRangePicker' => false,
        'showCheckBoxCalendar' => false
    ));

    Yii::app()->clientScript->registerScript('print', <<<JS
    $('#studentCard-print').click(function(e){
        e.preventDefault();
        var action=$("#filter-form").attr("action");
        $("#filter-form").attr("action", $(this).data('url'));
        $("#filter-form").submit();
        $("#filter-form").attr("action", action);
    });
JS
, CClientScript::POS_END);
}


echo <<<HTML
    <span id="spinner1"></span>
HTML;
if ($model->student) :
    $this->renderPartial('/filter_form/default/year_sem');


    $this->renderPartial('studentCard/_bottom', array(
        'st' => St::model()->findByPk($model->student),
    ));
endif;
