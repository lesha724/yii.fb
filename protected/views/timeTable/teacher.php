<?php
/**
 *
 * @var TimeTableController $this
 * @var TimeTableForm $model
 * @var CActiveForm $form
 */

$this->pageHeader=tt('Расписание преподавателя');
$this->breadcrumbs=array(
    tt('Расписание'),
);

Yii::app()->clientScript->registerPackage('jquery.ui');
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/timetable/timetable.js', CClientScript::POS_HEAD);

$popupTitle = tt('Информация о преподавателе');
Yii::app()->clientScript->registerScript('teacher-messages', <<<JS
    tt.popupTitle = '{$popupTitle}';
JS
    , CClientScript::POS_READY);

$attr = array('class'=>'chosen-select', 'autocomplete' => 'off', 'empty' => '&nbsp;');
$form=$this->beginWidget('CActiveForm', array(
    'id'=>'timeTable-form',
    'htmlOptions' => array('class' => 'form-inline')
));

$html = '<div>';
    $html .= '<fieldset>';
    $filials = CHtml::listData(Ks::model()->findAll(), 'ks1', 'ks2');
    if (count($filials) > 1) {
        $html .= '<div class="row-fluid span2">';
        $html .= $form->label($model, 'filial');
        $html .= $form->dropDownList($model, 'filial', $filials, $attr);
        $html .= '</div>';
    }

    $chairs = CHtml::listData(K::model()->getOnlyChairsFor($model->filial), 'k1', 'k3');
    $html .= '<div class="row-fluid span2">';
    $html .= $form->label($model, 'chair');
    $html .= $form->dropDownList($model, 'chair', $chairs, $attr);
    $html .= '</div>';

    $teachers = P::model()->getTeachersForTimeTable($model->chair);
    $html .= '<div class="row-fluid span2">';
    $html .= $form->label($model, 'teacher');
    $html .= $form->dropDownList($model, 'teacher', $teachers, $attr);
    $html .= '</div>';


    $html .= $form->hiddenField($model, 'date1');
    $html .= $form->hiddenField($model, 'date2');
    $html .= '</fieldset>';

    $html .= '<fieldset style="margin-top:1%;">';
    $html .= $this->renderPartial('_date_interval', array(
        'date1' => $model->date1,
        'date2' => $model->date2,
        'r11'   => $model->r11,
    ), true);

    $html .= '<div class="row-fluid span3" style="margin-left: 0">';
    $html .= $form->label($model, 'r11');
    $html .= ' '.$form->textField($model, 'r11', array('class'=>'input-mini span2', 'placeholder' => tt('дней'), 'style'=>'background:'.TimeTableForm::r11Color));
    $html .= '</div>';
    $html .= '</fieldset>';
$html .= '</div>';

    echo $html;

$this->endWidget();

echo <<<HTML
    <span id="spinner1"></span>
HTML;



if (! empty($model->teacher))


if (! empty($model->teacher)) {

    $text = tt('Нажмите здесь для просмотра фотографии преподавателя');
    echo <<<HTML
<h3 class="blue header lighter tooltip-info">
    <i class="icon-info-sign show-info" style="cursor:pointer"></i>
    <small>
        <i class="icon-double-angle-right"></i> {$text}
    </small>
</h3>
HTML;

    $this->renderPartial('schedule', array(
        'model'      => $model,
        'timeTable'  => $timeTable,
        'minMax'     => $minMax,
        'rz'         => $rz,
        'maxLessons' => array(),
    ));

    $url = $this->createUrl('site/userPhoto', array('_id' => $model->teacher, 'type' => Users::FOTO_P1));
    echo <<<HTML
<div id="dialog-message" class="hide">
    <div id="foto">
        <img src="{$url}" alt="">
    </div>
    <div class="hr hr-12 hr-double"></div>
    <div id="info"></div>
</div><!-- #dialog-message -->
HTML;

}
