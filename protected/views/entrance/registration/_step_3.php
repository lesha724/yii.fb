<?php
/**
 * @var Aap $model
 */
?>
<div class="step-pane" id="step3">

    <?php

        $citizenship = Sgr::model()->getAllCitizenship();
        $data = CHtml::listData($citizenship, 'sgr1', 'sgr2');
        $label = $form->label($model, 'aap8', $labelOptions);
        $input = $form->dropDownList($model, 'aap8', $data, $inputOptions+array('empty' => ''));
        echo sprintf($pattern, $label, $input);

        $data = array(
            tt('Паспорт'),
            tt('Свидетельство о рождении'),
            tt('Военный билет'),
        );
        $label = $form->label($model, 'aap18', $labelOptions);
        $input = $form->dropDownList($model, 'aap18', $data, $inputOptions);
        echo sprintf($pattern, $label, $input);

        $label = $form->label($model, 'aap19', $labelOptions);
        $input = $form->textField($model, 'aap19', $inputOptions);
        echo sprintf($pattern, $label, $input);

        $label = $form->label($model, 'aap20', $labelOptions);
        $input = $form->textField($model, 'aap20', $inputOptions);
        echo sprintf($pattern, $label, $input);

        $label = $form->label($model, 'aap21', $labelOptions);
        $input = $form->textArea($model, 'aap21', $inputOptions);
        echo sprintf($pattern, $label, $input);

        $options = array('class' => 'datepicker');
        $label = $form->label($model, 'aap22', $labelOptions);
        $input = $form->textField($model, 'aap22', $options);
        echo sprintf($pattern, $label, $input);
    ?>
</div>