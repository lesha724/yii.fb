<?php
/**
 * Created by PhpStorm.
 * User: NEFF
 * Date: 12.01.2018
 * Time: 11:50
 */

/* @var $this DistEducationController */
/* @var $model DistEducationFilterForm */

$this->pageHeader=tt('Дистанционное образование: запись');
$this->breadcrumbs=array(
    tt('Дистанционное образование'),
);

Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/distEducation/subscription.js', CClientScript::POS_HEAD);

$this->renderPartial('/filter_form/default/year_sem');

$discipline = $model->discipline;

echo <<<HTML
    <span id="spinner1"></span>
HTML;

/**
 * @var $form CActiveForm
 */

echo '<form class="form-inline" method="POST">';
$chairs = CHtml::listData(K::model()->getAllChairs(), 'k1', 'k3');
echo CHtml::dropDownList('chairId', $model->chairId, $chairs, array('class'=>'chosen-select chosen-chairId', 'autocomplete' => 'off', 'empty' => ''));
echo '</form>';



if(!empty($model->chairId)) {

    $form=$this->beginWidget('CActiveForm', array(
        'id'=>'filter-form',
        'htmlOptions' => array('class' => 'form-inline')
    ));

    echo '<div>';

    $disciplines = CHtml::listData($model->getDispListForDistEducation()->data, 'uo1', function ($data) {
        return $data['d2'] . ' / ' . $data['sp2'] . '-'.$data['sem4'].' курс';
    });

    echo '<div class="span2 ace-select">' .
        $form->label($model, 'discipline') .
        $form->dropDownList($model, 'discipline', $disciplines, array('class' => 'chosen-select', 'autocomplete' => 'off', 'empty' => '&nbsp;')) .
        '</div>';

    echo '</div>';

    $this->endWidget();
}




if(!empty($discipline)):


endif;