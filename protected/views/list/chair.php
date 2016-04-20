<?php
/**
 *
 * @var WorkPlanController $this
 * @var FilterForm $model
 */

$this->pageHeader=tt('Список кафедры');
$this->breadcrumbs=array(
    tt('Список кафедры'),
);

Yii::app()->clientScript->registerPackage('dataTables');
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/workPlan/main.js', CClientScript::POS_HEAD);
$attr = array('class'=>'chosen-select', 'autocomplete' => 'off', 'empty' => '&nbsp;');
$form=$this->beginWidget('CActiveForm', array(
    'id'=>'timeTable-form',
    'htmlOptions' => array('class' => 'form-inline noprint')
));

$html = '<div>';
    $html .= '<fieldset>';
    //$filials = CHtml::listData(Ks::model()->findAllByAttributes(array('ks12'=>null,'ks13'=>0)), 'ks1', 'ks2');
    $filials = CHtml::listData(Ks::model()->findAllByAttributes(array('ks12'=>null,'ks13'=>0)), 'ks1', Ks::getFieldByLanguage(false));
    if (count($filials) > 1) {
        $html .= '<div class="span2 ace-select">';
        $html .= $form->label($model, 'filial');
        $html .= $form->dropDownList($model, 'filial', $filials, $attr);
        $html .= '</div>';
    }

    $chairs = CHtml::listData(K::model()->getOnlyChairsFor($model->filial), 'k1', 'k3');
    $html .= '<div class="span2 ace-select">';
    $html .= $form->label($model, 'chair');
    $html .= $form->dropDownList($model, 'chair', $chairs, $attr);
    $html .= '</div>';

    $html .= '</fieldset>';
    $html .= '</div>';

    echo $html;

$this->endWidget();


echo <<<HTML
    <span id="spinner1"></span>
HTML;


if (! empty($model->chair))
    $this->renderPartial('chair/_bottom', array(
        'model' => $model,
    ));
