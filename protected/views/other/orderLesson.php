<?php
/**
 *
 * @var OtherController $this
 * @var TimeTableForm $model
 * @var CActiveForm $form
 */

$html = $this->renderPartial('/timeTable/group', array(
    'model'      => $model,
    'timeTable'  => $timeTable,
    'minMax'     => $minMax,
    'maxLessons' => $maxLessons,
    'rz'         => Rz::model()->getRzArray($model->filial),
    'type'=>$type
), true);


$this->pageHeader=tt('Заказ переноса занятий');
$this->breadcrumbs=array(
    tt('Другое'),
);

Yii::app()->clientScript->registerPackage('jquery.ui');
Yii::app()->clientScript->registerPackage('datepicker');
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/other/orderLesson.js', CClientScript::POS_HEAD);

$orderLesson = tt('Заказать перенос занятия?');
$cancel      = tt('Отмена');
$successful  = tt('Ваш запрос успешно отправлен!');
$error       = tt('Произошла ошибка!');

Yii::app()->clientScript->registerScript('orderLesson-messages', <<<JS
    tt.orderLesson  = '{$orderLesson}';
    tt.cancel       = '{$cancel}';
    tt.successful   = '{$successful}';
    tt.error        = '{$error}';
JS
    , CClientScript::POS_READY);

    echo $html;
    $this->renderPartial('orderLesson/popup', array());
?>

<h3 class="blue header lighter tooltip-info hide">
    <i class="icon-info-sign"></i>
    <small>
        <i class="icon-double-angle-right"></i>
        <?=tt('Выберите ячейку и нажмите на клавиатуре кнопку `Delete`, чтобы заказать перенос занятия')?>
    </small>
</h3>
