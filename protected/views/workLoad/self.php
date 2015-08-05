<?php
/**
 *
 * @var WorkLoadController $this
 * @var FilterForm $model
 */

$this->pageHeader=tt('Нагрузка преподавателя');
$this->breadcrumbs=array(
    tt('Нагрузка'),
);

Yii::app()->clientScript->registerPackage('dataTables');
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/workLoad/main.js', CClientScript::POS_HEAD);
//$teachers = P::model()->getArrayPd(Yii::app()->user->dbModel->p1);
$options = array('class'=>'chosen-select', 'autocomplete' => 'off', 'empty' => '&nbsp;', 'style' => 'width:200px');
if(count($teachers)>1)
{
    $form=$this->beginWidget('CActiveForm', array(
        'id'=>'filter-form',
        'htmlOptions' => array('class' => 'form-inline')
    ));

        $html  = '<div>';
            $html .= '<fieldset>';
            $html .= '<div class="span3 ace-select">';
            $html .= $form->label($model, 'teacher');
            $html .= $form->dropDownList($model, 'teacher',  CHtml::listData($teachers,'pd1','title'), $options);
            $html .= '</fieldset>';
        $html .= '</div>';


        echo $html;

    $this->endWidget();
}else
{
    $val=current($teachers);
    if($val!==false)
    {
        $model->teacher=$val['pd1'];
    }
}
echo <<<HTML
    <span id="spinner1"></span>
HTML;


if (! empty($model->teacher))
    $this->renderPartial('_bottom/_teacher', array(
        'model' => $model,
        //'type'=>$type
    ));
