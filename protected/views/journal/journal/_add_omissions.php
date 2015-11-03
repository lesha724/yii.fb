<div class="">

    <h4 class="page-header"><?=tt('Регистрация пропуска')?></h4>
    <?php
    $pattern = <<<HTML
<div class="control-group">
    %s
    <div class="controls">
        %s
    </div>
</div>
HTML;
    $options = array(
        'class' => 'control-label'
    );

    $form=$this->beginWidget('CActiveForm', array(
        'id'=>'omissions-form',
        'htmlOptions' => array('class' => 'form-horizontal')
    ));
    $html = '<div>';
    $html .= $form->errorSummary($model, null, null, array('class' => 'alert alert-error'));

    $input = $form->hiddenField($model, 'elgp0');
    $html .= $input;


    $label = $form->label($model, 'elgp2', $options);
    $input = $form->textField($model, 'elgp2');
    $html .= sprintf($pattern, $label, $input);

    $label = $form->label($model, 'elgp3', $options);
    $input = $form->textField($model, 'elgp3');
    $html .= sprintf($pattern, $label, $input);

    $label = $form->label($model, 'elgp4', $options);
    $input = $form->textField($model, 'elgp4');
    $html .= sprintf($pattern, $label, $input);

    $label = $form->label($model, 'elgp5', $options);
    $input = $form->textField($model, 'elgp5',array('class' => 'datepicker'));
    $html .= sprintf($pattern, $label, $input);

    $html .= '</div>';
    echo $html;

    $this->endWidget();
    ?>
</div>