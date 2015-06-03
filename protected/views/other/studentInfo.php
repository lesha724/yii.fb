<?php
/**
 *
 * @var OtherController $this
 * @var TimeTableForm $model
 */

Yii::app()->clientScript->registerPackage('autocomplete');
Yii::app()->clientScript->registerPackage('gritter');
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/other/studentInfo.js', CClientScript::POS_HEAD);

$this->pageHeader=tt('Данные студента');
$this->breadcrumbs=array(
    tt('Другое'),
);

?>

<?php
    if ($canSelectSt) :

        Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/timetable/timetable.js', CClientScript::POS_HEAD);

        $this->renderPartial('/filter_form/timeTable/student', array(
            'model' => $model,
            'showDateRangePicker' => false
        ));

        echo <<<HTML
    <div class="hr hr-18 dotted hr-double"></div>
HTML;

    endif;

    if ($model->student) :

        $this->renderPartial('studentInfo/_bottom', array(
            'model' => $model,
            'stInfoForm' => $stInfoForm
        ));

    endif;
?>



