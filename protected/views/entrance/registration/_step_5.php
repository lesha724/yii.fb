<?php
/**
 * @var Aap $model
 */
?>
<div class="step-pane" id="step5">

    <?php

        $documents = Dob::model()->getAllDocuments();
        $data  = CHtml::listData($documents, 'dob1', 'dob2');
        $label = $form->label($model, 'aap9', $labelOptions);
        $input = $form->dropDownList($model, 'aap9', $data, $inputOptions+array('empty' => ''));
        echo sprintf($pattern, $label, $input);

        $label = $form->label($model, 'aap11', $labelOptions);
        $input = $form->textField($model, 'aap11', $inputOptions);
        echo sprintf($pattern, $label, $input);

        $options = array('class' => 'datepicker');
        $label = $form->label($model, 'aap13', $labelOptions);
        $input = $form->textField($model, 'aap13', $options);
        echo sprintf($pattern, $label, $input);

        $label = $form->label($model, 'aap14', $labelOptions);
        $input = $form->textField($model, 'aap14', $inputOptions);
        echo sprintf($pattern, $label, $input);
    ?>
    <hr>
    <h3 class="lighter block green">
        <?=tt('Адрес учебного заведения')?>:
    </h3>
    <?php

        $countries = Das::model()->getAllCountries();
        $data  = CHtml::listData($countries, 'das1', 'das2');
        $label = $form->label($model, 'country3', $labelOptions);
        $input = $form->dropDownList($model, 'country3', $data, $inputOptions+array('empty' => ''));
        echo sprintf($pattern, $label, $input);


        $regions = Dao::model()->getAllRegionsFor($model->country3);
        $data  = CHtml::listData($regions, 'dao1', 'dao3');
        $label = $form->label($model, 'region3', $labelOptions);
        $input = $form->dropDownList($model, 'region3', $data, $inputOptions);
        echo sprintf($pattern, $label, $input);


        $cities = Da::model()->getAllCitiesFor($model->country3, $model->region3);
        $data  = CHtml::listData($cities, 'da1', 'name');
        $label = $form->label($model, 'aap55', $labelOptions);
        $input = $form->dropDownList($model, 'aap55', array(tt('Другой'))+$data, $inputOptions+array('empty' => ''));
        echo sprintf($pattern, $label, $input);


        $label = $form->label($model, 'aap61', $labelOptions);
        $input = $form->textField($model, 'aap61', $inputOptions);
        echo '<div class="hide">'.sprintf($pattern, $label, $input).'</div>';

        echo '<hr>';

        $types = Zuz::model()->getAllTypes();
        $data  = CHtml::listData($types, 'zuz1', 'zuz2');
        $label = $form->label($model, 'aap54', $labelOptions);
        $input = $form->dropDownList($model, 'aap54', $data, $inputOptions+array('empty' => ''));
        echo sprintf($pattern, $label, $input);

        $label = $form->label($model, 'aap38', $labelOptions);
        $input = $form->textArea($model, 'aap38', $inputOptions);
        echo sprintf($pattern, $label, $input);

        $data = array(
            tt('Отсутствует'),
            tt('Золотая медаль'),
            tt('Серебряная медаль'),
            tt('Диплом с отличием'),
            tt('Аттестат с отличием'),
        );
        $label = $form->label($model, 'aap10', $labelOptions);
        $input = $form->dropDownList($model, 'aap10', $data, $inputOptions);
        echo sprintf($pattern, $label, $input);

        $data = array(
            tt('Имеется'),
            tt('Не имеется'),
        );
        $label = $form->label($model, 'aap58', $labelOptions);
        $input = $form->dropDownList($model, 'aap58', $data, $inputOptions);
        echo sprintf($pattern, $label, $input);
    ?>
</div>