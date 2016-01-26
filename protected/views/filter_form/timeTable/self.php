<?php
/**
 *
 * @var TimeTableForm || FilterForm $model
 * @var CActiveForm $form
 */
$options = array('class'=>'chosen-select', 'autocomplete' => 'off', 'empty' => '&nbsp;');
$form=$this->beginWidget('CActiveForm', array(
    'id'=>'filter-form',
    'htmlOptions' => array('class' => 'form-inline')
));

    $html = '<div>';
    $html .= '<fieldset>';

    $html .= $this->renderPartial('_date_interval', array(
        'date1' => $model->date1,
        'date2' => $model->date2,
        'r11'   => $model->r11,
        'showSem'=>true,
        'gr1'=>$model->group,
    ), true);

    $html .= $form->hiddenField($model, 'date1');
    $html .= $form->hiddenField($model, 'date2');

    $html .= '<div class="span2 ace-block">';
    $html .= $form->label($model, 'r11');
    $html .= ' '.$form->textField($model, 'r11', array('class'=>'input-mini', 'placeholder' => tt('дней'), 'style'=>'background:'.TimeTableForm::r11Color));
    $html .= '</div>';

    $html .= '</fieldset>';
		

	if (isset($showCheckBoxCalendar)&&$showCheckBoxCalendar) {
			$text=tt('Календарь');
			$checked='';
			if($type==1)
				$checked='checked';
			$html .= CHtml::hiddenField('timeTable',$type);
			$html .= <<<HTML
				<label class="pull-right inline">
					<small class="muted">{$text}</small>
					<input id="checkbox-timeTable" type="checkbox" {$checked} class="ace ace-switch ace-switch-6">
					<span class="lbl"></span>
				</label>
HTML;
		}

    $html .= '</div>';

    echo $html;

$this->endWidget();