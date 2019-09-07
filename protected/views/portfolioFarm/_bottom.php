<?php
/**
 * Created by PhpStorm.
 * User: neffa
 * Date: 04.02.2019
 * Time: 13:22
 */

/**
 * @param $number string номер
 * @param $code int
 * @param $name string
 * @param $needFile bool
 * @param $inputType string
 * @param $value string
 * @return string
 */
function renderField($number, $code, $name, $needFile, $inputType, $value = ''){
    $html = CHtml::openTag('ol');
    $html .= CHtml::tag('span', array(), $number);
    $html .= CHtml::openTag('div', array(
        'class' => 'control-group'
    ));
    $html .= CHtml::label($name,'field-'.$code, array(
        'class' => 'control-label'
    ));
    $html .= CHtml::$inputType('field-'.$code, $value, array(
        'class' => 'field-input',
        'data-id' => $code
    ));
    $html .= CHtml::closeTag('div');
    if($needFile) {
        $html .= CHtml::openTag('div', array(
            'class' => 'file-control-group'
        ));
        $html .= CHtml::fileField('field-file-' . $code, $value, array(
            'class' => 'field-file-input',
            'data-id' => $code
        ));
        $html .= CHtml::closeTag('div');
    }
    $html .= CHtml::closeTag('ol');
    return $html;
}


/**
 * @var $this PortfolioFarmController
 * @var St $student
 * @var TimeTableForm $model
 */
Yii::app()->clientScript->registerCss('portfolioFarm', <<<CSS
    .control-group textarea{
        width: 500px;
        height: 80px;
    }
CSS
    );

$url = Yii::app()->createUrl('/portfolioFarm/changeField');
$spinner1 = '$spinner1';

Yii::app()->clientScript->registerScript('portfolioFarm', <<<JS
    var successFieldMessage = 'Изменение сохранено';
    
    $('.field-input').change(function(event) {
        $spinner1.show();
        var url = '{$url}';
        
        var parentControl = $(this).closest('.control-group');
        
        var params = {
            st1:{$model->student},
            id: $(this).data('id'),
            value:$(this).val()
        };
        
        $.ajax({
            type: 'POST',
            url:  url,
            data: params,
            dataType: 'json',
            success: function(data) {
                addGritter('', successFieldMessage, 'success');
                $spinner1.hide();
                parentControl.removeClass('error');
                parentControl.addClass('success');
            },
            error: function(jqXHR, textStatus, errorThrown){
                addGritter('', textStatus + ':'+ jqXHR.responseText, 'error');
                $spinner1.hide();
                parentControl.removeClass('success');
                parentControl.addClass('error');
            }
        });
    });
JS
   , CClientScript::POS_END );

$fields = Stportfolio::model()->getFieldsList($student->st1);

echo '<div class="page-header">
  <h3>1.РЕЗЮМЕ</h3>
</div>';

$this->renderPartial('_stInfo', array(
    'student' => $student,
    'model' => $model,
));

echo CHtml::openTag('ul');

$field = $fields[Stportfolio::FIELD_EXTRA_EDUCATION];
echo renderField('', $field['code'], $field['text'], $field['needFile'], $field['inputType'], $field['value']);

$field = $fields[Stportfolio::FIELD_WORK_EXPERIENCE];
echo renderField('',  $field['code'], $field['text'], $field['needFile'], $field['inputType'], $field['value']);

$field = $fields[Stportfolio::FIELD_PHONE];
echo renderField('',  $field['code'], $field['text'], $field['needFile'], $field['inputType'], $field['value']);

$field = $fields[Stportfolio::FIELD_EMAIL];
echo renderField('',  $field['code'], $field['text'], $field['needFile'], $field['inputType'], $field['value']);

echo CHtml::closeTag('ul');


echo '<div class="page-header">
  <h3>2.ПОРТФОЛІО ДОСЯГНЕНЬ</h3>
</div>';

echo CHtml::openTag('ul');

$field = $fields[Stportfolio::FIELD_EXTRA_COURSES];
echo renderField('2.2', $field['code'], $field['text'], $field['needFile'], $field['inputType'], $field['value']);

$field = $fields[Stportfolio::FIELD_OLIMPIADS];
echo renderField('2.4',  $field['code'], $field['text'], $field['needFile'], $field['inputType'], $field['value']);

$field = $fields[Stportfolio::FIELD_SPORTS];
echo renderField('2.5',  $field['code'], $field['text'], $field['needFile'], $field['inputType'], $field['value']);

$field = $fields[Stportfolio::FIELD_SCIENCES];
echo renderField('2.6',  $field['code'], $field['text'], $field['needFile'], $field['inputType'], $field['value']);

$field = $fields[Stportfolio::FIELD_STUD_ORGS];
echo renderField('2.7',  $field['code'], $field['text'], $field['needFile'], $field['inputType'], $field['value']);

$field = $fields[Stportfolio::FIELD_VOLONTER];
echo renderField('2.8',  $field['code'], $field['text'], $field['needFile'], $field['inputType'], $field['value']);

$field = $fields[Stportfolio::FIELD_GROMADSKE];
echo renderField('2.9',  $field['code'], $field['text'], $field['needFile'], $field['inputType'], $field['value']);

echo CHtml::closeTag('ul');



echo '<div class="page-header">
  <h3>3.ПОРТФОЛІО РОБІТ</h3>
</div>';

echo '<div class="page-header">
  <h3>4.ПОРТФОЛІО ВІДГУКІВ</h3>
</div>';



