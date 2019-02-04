<?php
/**
 * Created by PhpStorm.
 * User: neffa
 * Date: 04.02.2019
 * Time: 13:22
 */

$this->pageHeader=tt('Предаватель');
$this->breadcrumbs=array(
    tt('Портфолио'),
);

if(Yii::app()->user->isAdmin) {

    Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/timetable/timetable.js', CClientScript::POS_HEAD);

    $attr = array('class'=>'chosen-select', 'autocomplete' => 'off', 'empty' => '&nbsp;');
    $form=$this->beginWidget('CActiveForm', array(
        'id'=>'timeTable-form',
        'action'=>array('teacher'),
        'htmlOptions' => array('class' => 'form-inline')
    ));

    $ps64 = PortalSettings::model()->findByPk(64)->ps2;

    $html = '<div>';
    $html .= '<fieldset>';

    $filials = Ks::getListDataForKsFilter();
    if (count($filials) > 1) {
        $html .= '<div class="span2 ace-select">';
        $html .= $form->label($model, 'filial');
        $html .= $form->dropDownList($model, 'filial', $filials, $attr);
        $html .= '</div>';
    }else{
        $model->filial = key($filials);
    }

    //$chairs = CHtml::listData(K::model()->getOnlyChairsFor($model->filial), 'k1', 'k3');
    $chairs = K::model()->getOnlyChairsFor($model->filial);
    $html .= '<div class="span2 ace-select">';
    $html .= $form->label($model, 'chair');
    $html .= $form->dropDownList($model, 'chair', $chairs, $attr);
    $html .= '</div>';

    $teachers = P::model()->getTeachersForTimeTable($model->chair);
    $html .= '<div class="span2 ace-select">';
    $html .= $form->label($model, 'teacher');
    $html .= $form->dropDownList($model, 'teacher', $teachers, $attr);
    $html .= '</div>';
    $html .= '</fieldset>';
    $html .= '</div>';

    echo $html;

    $this->endWidget();
}


echo <<<HTML
    <span id="spinner1"></span>
HTML;
if ($model->teacher) :
    $this->renderPartial('teacher/_bottom', array(
        'teacher' => P::model()->findByPk($model->teacher),
    ));
endif;