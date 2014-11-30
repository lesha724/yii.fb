<?php

    $form=$this->beginWidget('CActiveForm', array(
        'id'=>'filter-form',
    ));

    $disciplines = CHtml::listData(D::model()->getDisciplinesForExamSession($type), 'id', 'name');

    echo '<div>'.
            $form->label($model, 'discipline').
            $form->dropDownList($model, 'discipline', $disciplines, array('class'=>'chosen-select', 'autocomplete' => 'off', 'empty' => '&nbsp;', 'style'=>'width:350px')).
            CHtml::hiddenField('type', $type).
        '</div>';

    $this->endWidget();

echo <<<HTML
    <span id="spinner1"></span>
HTML;
