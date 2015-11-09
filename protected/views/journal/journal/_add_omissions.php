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

        if(empty($model->elgp2))
            $model->elgp2=1;

        $label = $form->label($model, 'elgp2', $options);
        $input = $form->dropDownList($model, 'elgp2',CHtml::listData(Elgzst::model()->getTypesByGroup(),'id','text','group'));
        $html .= sprintf($pattern, $label, $input);

        $label = $form->label($model, 'elgp3', $options);
        $input = $form->textField($model, 'elgp3');
        $html .= sprintf($pattern, $label, $input);

        $style='';
        if($model->elgp2!=5)
            $style='style="display: none"';

        $html .='<div id="elgp" '.$style.'>';
            $label = $form->label($model, 'elgp4', $options);
            $input = $form->textField($model, 'elgp4');
            $html .= sprintf($pattern, $label, $input);

            $model->elgp5=date('d.m.y',strtotime($model->elgp5));
            $label = $form->label($model, 'elgp5', $options);
            $input = $form->textField($model, 'elgp5',array('class' => 'datepicker'));
            $html .= sprintf($pattern, $label, $input);
        $html .= '</div>';

    $html .= '</div>';
    echo $html;

    $this->endWidget();
    ?>
</div>