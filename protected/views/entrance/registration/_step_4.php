<?php
/**
 * @var Aap $model
 */
?>
<div class="step-pane" id="step4">

    <h3 class="lighter block green">
        <?=tt('Адрес регистрации')?>:
    </h3>
    <?php

        $countries = Das::model()->getAllCountries();
        $data  = CHtml::listData($countries, 'das1', 'das2');
        $label = $form->label($model, 'country1', $labelOptions);
        $input = $form->dropDownList($model, 'country1', $data, $inputOptions+array('empty' => ''));
        echo sprintf($pattern, $label, $input);


        $regions = Dao::model()->getAllRegionsFor($model->country1);
        $data  = CHtml::listData($regions, 'dao1', 'dao3');
        $label = $form->label($model, 'region1', $labelOptions);
        $input = $form->dropDownList($model, 'region1', $data, $inputOptions);
        echo sprintf($pattern, $label, $input);


        $cities = Da::model()->getAllCitiesFor($model->country1, $model->region1);
        $data  = CHtml::listData($cities, 'da1', 'name');
        $label = $form->label($model, 'aap28', $labelOptions);
        $input = $form->dropDownList($model, 'aap28', array(tt('Другой'))+$data, $inputOptions+array('empty' => ''));
        echo sprintf($pattern, $label, $input);


        $label = $form->label($model, 'aap37', $labelOptions);
        $input = $form->textField($model, 'aap37', $inputOptions);
        echo '<div class="hide">'.sprintf($pattern, $label, $input).'</div>';


        $label = $form->label($model, 'aap29', $labelOptions);
        $input = $form->textField($model, 'aap29', $inputOptions);
        echo sprintf($pattern, $label, $input);

        $label = $form->label($model, 'aap30', $labelOptions);
        $input = $form->textField($model, 'aap30', $inputOptions);
        echo sprintf($pattern, $label, $input);

        $label = $form->label($model, 'aap31', $labelOptions);
        $input = $form->textField($model, 'aap31', $inputOptions);
        echo sprintf($pattern, $label, $input);

        $label = $form->label($model, 'aap32', $labelOptions);
        $input = $form->textField($model, 'aap32', $inputOptions);
        echo sprintf($pattern, $label, $input);

        $translate = tt('Адрес фактического проживания такой же');
        $button = <<<HTML
            <button class="btn btn-info copy-address" type="button"><i class="icon-pencil bigger-125"></i>{$translate}</button>
HTML;
        echo sprintf($pattern, '', $button);
    ?>
        <hr>
        <h3 class="lighter block green">
            <?=tt('Адрес фактического проживания')?>:
        </h3>
    <?php

        $countries = Das::model()->getAllCountries();
        $data  = CHtml::listData($countries, 'das1', 'das2');
        $label = $form->label($model, 'country2', $labelOptions);
        $input = $form->dropDownList($model, 'country2', $data, $inputOptions+array('empty' => ''));
        echo sprintf($pattern, $label, $input);


        $regions = Dao::model()->getAllRegionsFor($model->country2);
        $data  = CHtml::listData($regions, 'dao1', 'dao3');
        $label = $form->label($model, 'region2', $labelOptions);
        $input = $form->dropDownList($model, 'region2', $data, $inputOptions);
        echo sprintf($pattern, $label, $input);


        $cities = Da::model()->getAllCitiesFor($model->country2, $model->region2);
        $data  = CHtml::listData($cities, 'da1', 'name');
        $label = $form->label($model, 'aap23', $labelOptions);
        $input = $form->dropDownList($model, 'aap23', array(tt('Другой'))+$data, $inputOptions+array('empty' => ''));
        echo sprintf($pattern, $label, $input);


        $label = $form->label($model, 'aap36', $labelOptions);
        $input = $form->textField($model, 'aap36', $inputOptions);
        echo '<div class="hide">'.sprintf($pattern, $label, $input).'</div>';


        $label = $form->label($model, 'aap24', $labelOptions);
        $input = $form->textField($model, 'aap24', $inputOptions);
        echo sprintf($pattern, $label, $input);

        $label = $form->label($model, 'aap25', $labelOptions);
        $input = $form->textField($model, 'aap25', $inputOptions);
        echo sprintf($pattern, $label, $input);

        $label = $form->label($model, 'aap26', $labelOptions);
        $input = $form->textField($model, 'aap26', $inputOptions);
        echo sprintf($pattern, $label, $input);

        $label = $form->label($model, 'aap27', $labelOptions);
        $input = $form->textField($model, 'aap27', $inputOptions);
        echo sprintf($pattern, $label, $input);
    ?>
</div>