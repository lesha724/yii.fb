<?php
/**
 *
 * @var TimeTableController $this
 * @var TimeTableForm $model
 * @var CActiveForm $form
 */

$this->pageHeader=tt('Свободные аудитории');
$this->breadcrumbs=array(
    tt('Расписание'),
);

Yii::app()->clientScript->registerPackage('datepicker');
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/timetable/timetable.js', CClientScript::POS_HEAD);

$options = array('class'=>'chosen-select', 'autocomplete' => 'off', 'empty' => '&nbsp;');
$form=$this->beginWidget('CActiveForm', array(
    'id'=>'timeTable-form',
    'htmlOptions' => array('class' => 'form-inline')
));

$html  = '<div>';
    $html .= '<fieldset>';

    $html .= '<div class="row-fluid span1">';
    $html .= $form->label($model, 'date1');
    $html .= '<div class="input-append">';
    $html .= $form->textField($model, 'date1', array('class' => 'datepicker input-small input-mask-date'));
    $html .= '</div>';
    $html .= '</div>';

    $filials = CHtml::listData(Ks::model()->findAll(), 'ks1', 'ks2');
    if (count($filials) > 1) {
        $html .= '<div class="row-fluid span2">';
        $html .= $form->label($model, 'filial');
        $html .= $form->dropDownList($model, 'filial', $filials, $options);
        $html .= '</div>';
    }

    $housings = CHtml::listData(Ka::model()->getHousingFor($model->filial), 'ka1', 'ka2');
    if (count($housings) > 1) {
        $html .= '<div class="row-fluid span2">';
        $html .= $form->label($model, 'housing');
        $html .= $form->dropDownList($model, 'housing', $housings, $options);
        $html .= '</div>';
    }

    $lessons = CHtml::listData(Rz::model()->getRzForDropdown(), 'rz1', 'name');

    $html .= '<div class="row-fluid span2">';
    $html .= $form->label($model, 'lessonStart');
    $html .= $form->dropDownList($model, 'lessonStart', $lessons, $options);
    $html .= '</div>';

    $html .= '<div class="row-fluid span2">';
    $html .= $form->label($model, 'lessonEnd');
    $html .= $form->dropDownList($model, 'lessonEnd', $lessons, $options);
    $html .= '</div>';

    $html .= '<div class="row-fluid">
                <button class="btn btn-info btn-small" type="submit" style="margin:22px 0 0 0">
                Ок <i class="icon-arrow-right icon-on-right"></i>
               </button></div>';

    $html .= '</fieldset>';

$html .= '</div>';

echo $html;

$this->endWidget();

echo <<<HTML
    <span id="spinner1"></span>
HTML;

if (! empty($classrooms)) {
    $title = tt('Аудитории');
    $widget = <<<HTML
<div class="span10 widget-container-span" style="margin:0">
    <div class="widget-box">
        <div class="widget-header">
            <h5>%s</h5>
        </div>
        <div class="widget-body">
            <div class="widget-main row-fluid">
                <ul class="classrooms-list">
                    %s
                </ul>
            </div>
        </div>
    </div>
</div>
HTML;

    $element = <<<HTML
<li data-content="%s" data-rel="popover" class="%s">
    %s
</li>
HTML;

    $html = null;
    foreach ($classrooms as $classroom) {
        $post = array(
            'TimeTableForm' => array('classroom' => $classroom['a1'])
        );
        $href  = Yii::app()->createUrl('timeTable/classroom', $post);
        $link  = Chtml::link($classroom['a2'], $href, array('target' => '_blank'));
        $hint  = tt('Количество мест').': '.$classroom['a3'].'<br>'.tt('Примечание').': '.$classroom['a4'];
        $class = in_array($classroom['a1'], $occupiedRooms) ? 'btn-danger' : '';

        $html .= sprintf($element, $hint, $class, $link);
    }

    echo sprintf($widget, $title, $html);
}



