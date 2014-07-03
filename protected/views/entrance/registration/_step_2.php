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
<div class="step-pane active" id="step2">

    <?php
        $data = array(
            tt('Дневная'),
            tt('Заочная'),
            tt('Вечерняя'),
            tt('Экстернат'),
        );
        $label = $form->label($model, 'aap15', $labelOptions);
        $input = $form->dropDownList($model, 'aap15', $data, $inputOptions);
        echo sprintf($pattern, $label, $input);

        $data = array(
            tt('Мл. специалист'),
            tt('Бакалавр'),
            tt('Специалист'),
            tt('Магистр'),
        );
        $label = $form->label($model, 'aap57', $labelOptions);
        $input = $form->dropDownList($model, 'aap57', $data, $inputOptions);
        echo sprintf($pattern, $label, $input);

        $specialities = Spab::model()->getSpecialitiesForRegistration($model->aap15, $model->aap57, 1);
        $data = CHtml::listData($specialities, 'spab1', 'spab14');
        $label = $form->label($model, 'aap16', $labelOptions);
        $input = $form->dropDownList($model, 'aap16', $data, $inputOptions+array('empty' => ''));
        echo sprintf($pattern, $label, $input);

        $data = array(
            tt('Бюджет'),
            tt('Контракт'),
        );
        $label = $form->label($model, 'aap34', $labelOptions);
        $input = $form->dropDownList($model, 'aap34', $data, $inputOptions+array('empty' => ''));
        echo sprintf($pattern, $label, $input);

        $cns  = Cn::model()->getAllCn();
        $data = array(tt('Нет')) + CHtml::listData($cns, 'cn1', 'cn2');
        $label = $form->label($model, 'aap44', $labelOptions);
        $input = $form->dropDownList($model, 'aap44', $data, $inputOptions);
        echo sprintf($pattern, $label, $input);

        $oas  = Oa::model()->getAllOa();
        $data = array(tt('Нет')) + CHtml::listData($oas, 'oa1', 'oa2');
        $label = $form->label($model, 'aap45', $labelOptions);
        $input = $form->dropDownList($model, 'aap45', $data, $inputOptions);
        echo sprintf($pattern, $label, $input);

        $sls  = Sl::model()->getAllSl();
        $data = array(tt('Нет')) + CHtml::listData($sls, 'sl1', 'sl2');
        $label = $form->label($model, 'aap47', $labelOptions);
        $input = $form->dropDownList($model, 'aap47', $data, $inputOptions);
        echo sprintf($pattern, $label, $input);

        $data = array(
            tt('Нет'),
            tt('Да'),
        );
        $label = CHtml::label('Агроклассы', '', $labelOptions);
        $input = CHtml::dropDownList('agroClasses', '', $data, $inputOptions);
        echo sprintf($pattern, $label, $input);

        $label = $form->label($model, 'aap49', $labelOptions);
        $input = $form->textField($model, 'aap49', $inputOptions);
        echo sprintf($pattern, $label, $input);

        $data = array(
            tt('На базе 9 классов'),
            tt('На базе 11 классов'),
        );
        $label = $form->label($model, 'aap62', $labelOptions);
        $input = $form->dropDownList($model, 'aap62', $data, $inputOptions);
        echo sprintf($pattern, $label, $input);

        $sys  = Sy::model()->getAllSy();
        $data = array(tt('Нет')) + CHtml::listData($sys, 'sy1', 'sy2');
        $label = $form->label($model, 'aap35', $labelOptions);
        $input = $form->dropDownList($model, 'aap35', $data, $inputOptions);
        echo sprintf($pattern, $label, $input);

        $data = array(
            tt('Нет'),
            tt('Да'),
        );
        $label = $form->label($model, 'aap33', $labelOptions);
        $input = $form->dropDownList($model, 'aap33', $data, $inputOptions);
        echo sprintf($pattern, $label, $input);

        $data = array(
            1 => tt('Да'),
            0 => tt('Нет'),
        );
        $label = $form->label($model, 'aap50', $labelOptions);
        $input = $form->dropDownList($model, 'aap50', $data, $inputOptions);
        echo sprintf($pattern, $label, $input);
    ?>
</div>