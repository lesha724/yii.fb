<?php
/**
 * Created by PhpStorm.
 * User: NEFF
 * Date: 29.11.2017
 * Time: 15:37
 */
/**
 * @var $model DistEducationFilterForm
 */
/** @var $this DistEducationController */
/** @var array $disp */
/** @var array $coursesList */
/**
 * @var DistEducation $connector
 */

$pattern = <<<HTML
<div class="">
    %s
    <div class="">
        %s
    </div>
</div>
HTML;

$options = array(
    'class' => 'control-label col-sm-2'
);
?>


<h4><?=$disp['d2']?></h4>

<?php
/**
 * @var $form CActiveForm
 */
$form=$this->beginWidget('CActiveForm', array(
    'id'=>'retake-form',
    'htmlOptions' => array('class' => 'form-inline'),
    'action' => false
));

$html = '<div>';

$input = CHtml::hiddenField('filed_uo1', $disp['uo1']);
$html .= $input;

$input = CHtml::hiddenField('filed_k1',  $disp['uo4']);
$html .= $input;

/*$label = CHtml::label(tt('Курс'), 'dispdist3', $options);
$input = CHtml::dropDownList('filed_dispdist3', $disp['dispdist3'], $coursesList ,array('id'=>'chosen-dispdist3','class'=>'chosen-select', 'autocomplete' => 'off', 'empty' => ''));
$html .= sprintf($pattern, $label, $input);*/

$html .= '</div>';
echo $html;

$this->endWidget();

$this->renderPartial('_grid_courses', array(
    'disp' => $disp,
    'model'=>$model,
    'connector'=>$connector,
    'coursesList' => $connector->getCoursesList()
));