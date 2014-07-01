<?php
    $pattern = <<<HTML
<div class="control-group">
    %s
    <div class="controls">
        <div class="span12">
            %s
        </div>
    </div>
</div>
HTML;
$labelOptions = array(
    'class' => 'control-label'
);
$inputOptions = array(
    'class' => 'span6'
);
?>
<div class="step-pane " id="step1">

    <?php
        $label = $form->label($model, 'aap2', $labelOptions);
        $input = $form->textField($model, 'aap2', $inputOptions);
        echo sprintf($pattern, $label, $input);

        $label = $form->label($model, 'aap3', $labelOptions);
        $input = $form->textField($model, 'aap3', $inputOptions);
        echo sprintf($pattern, $label, $input);

        $label = $form->label($model, 'aap4', $labelOptions);
        $input = $form->textField($model, 'aap4', $inputOptions);
        echo sprintf($pattern, $label, $input);

        $options = array_merge($inputOptions, array(
            'class' => 'ace',
            'labelOptions' => array(
                'class' => 'lbl'
            )
        ));
        $label = $form->label($model, 'aap7', $labelOptions);
        $input = $form->radioButtonList($model, 'aap7', array('М', 'Ж'), $options);
        echo sprintf($pattern, $label, $input);

        $options = array('class' => 'datepicker');
        $label = $form->label($model, 'aap5', $labelOptions);
        $input = $form->textField($model, 'aap5', $options);
        echo sprintf($pattern, $label, $input);

        $options = array('class' => 'autosize span6', 'maxlength' => '100');
        $label = $form->label($model, 'aap6', $labelOptions);
        $input = $form->textArea($model, 'aap6', $options);
        echo sprintf($pattern, $label, $input);

        $data = array(
            tt('Холост/незамужем'),
            tt('Женат/замужем')
        );
        $label = $form->label($model, 'aap43', $labelOptions);
        $input = $form->dropDownList($model, 'aap43', $data, $inputOptions);
        echo sprintf($pattern, $label, $input);
    ?>
</div>