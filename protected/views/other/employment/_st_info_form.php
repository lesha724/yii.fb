<?php
/**
 * @var St $student
 * @var Sdp $models
 * @var CActiveForm $form
 */

$pattern1 = <<<HTML
<div class="control-group">
    <label class="control-label">%s:</label>
    <div class="controls">
        <span>
            <strong>%s</strong>
        </span>
    </div>
</div>
HTML;

$pattern2 = <<<HTML
<div class="control-group">
    %s
    <div class="controls">
        %s
    </div>
</div>
HTML;

$labelOptions = array('class' => 'control-label');
$inputOptions = array('style' => 'width:50%', 'autocomplete' => 'off');

if (! $isEditable)
    $inputOptions += array('disabled' => 'disabled');
?>

<div class="page-header position-relative">
    <h1>
        <?=tt('Информация о студенте')?>
    </h1>
</div>

<?php
$form=$this->beginWidget('CActiveForm', array(
    'id'=>'employment-st-info',
    'htmlOptions' => array('class' => 'employment-st-info form-horizontal')
));

    $html = $form->errorSummary($model);

    $info = $student->specialityGroupCourse;

    $html .= sprintf($pattern1, tt('Ф.И.О.'), $student->fullName);
    $html .= sprintf($pattern1, tt('Специальность'), $info['pnsp2']);
    $html .= sprintf($pattern1, tt('Группа'), $info['gr']);
    $html .= sprintf($pattern1, tt('Курс'), $info['st56']);


    $label = $form->label($model, 'sdp30', $labelOptions);
    $input = $form->textField($model, 'sdp30', $inputOptions);
    $html .= sprintf($pattern2, $label, $input, null);

    $label = $form->label($model, 'sdp31', $labelOptions);
    $input = $form->textField($model, 'sdp31', $inputOptions);
    $html .= sprintf($pattern2, $label, $input, null);

    $label = $form->label($model, 'sdp4', $labelOptions);
    $input = $form->textArea($model, 'sdp4', $inputOptions + array('placeholder' => tt('Тема дипломной работы')));
    $html .= sprintf($pattern2, $label, $input);

    $label = $form->label($model, 'sdp26', $labelOptions);
    $input = $form->textArea($model, 'sdp26', $inputOptions + array('placeholder' => tt('Информация об опыте работы и сертификатах')));
    $html .= sprintf($pattern2, $label, $input);

    $label = $form->label($model, 'sdp27', $labelOptions);
    $input = $form->textArea($model, 'sdp27', $inputOptions + array('placeholder' => tt('Чем нравится заниматься')));
    $html .= sprintf($pattern2, $label, $input);

    $label = $form->label($model, 'sdp28', $labelOptions);
    $input = $form->textArea($model, 'sdp28', $inputOptions + array('placeholder' => tt('Предполагаемое или фактическое место работы')));
    $html .= sprintf($pattern2, $label, $input);


    $label = $form->label($model, 'sdp32', $labelOptions);
    $input = $form->checkBox($model, 'sdp32', array('value'=>1, 'uncheckValue'=>2, 'style'=>'')+$inputOptions);
    $html .= sprintf($pattern2, $label, $input);

    $label = $form->label($model, 'sdp33', $labelOptions);
    $input = $form->checkBox($model, 'sdp33', array('value'=>1, 'uncheckValue'=>2, 'style'=>'')+$inputOptions);
    $html .= sprintf($pattern2, $label, $input);

    if ($isEditable) {
        $text  = tt('Сохранить изменения');
        $html .= <<<HTML
    <div class="form-actions">
        <button type="submit" class="btn btn-info">
            <i class="icon-ok bigger-110"></i>
            {$text}
        </button>
    </div>
HTML;
    }

    echo $html;

$this->endWidget();


?>