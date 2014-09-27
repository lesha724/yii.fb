<?php

    Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/widget/filter_form.js', CClientScript::POS_HEAD);

    $getGroupUrl = Yii::app()->createAbsoluteUrl('/progress/getGroups');
    Yii::app()->clientScript->registerScript('getGroupUrl', <<<JS
        getGroupsUrl = "{$getGroupUrl}"
JS
    , CClientScript::POS_READY);

    $form=$this->beginWidget('CActiveForm', array(
        'id'=>'filter-form',
    ));

        $disciplines = CHtml::listData(D::model()->getDisciplines($type), 'd1', 'd2');
        echo $form->label($model, 'discipline');
        echo $form->dropDownList($model, 'discipline', $disciplines, array('class'=>'chosen-select', 'autocomplete' => 'off', 'empty' => '&nbsp;'));

        $groups = CHtml::listData(Gr::model()->getGroupsFor($model->discipline, $type), 'gr1', 'name');
        echo $form->label($model, 'group');
        echo $form->dropDownList($model, 'group', $groups, array('class'=>'chosen-select', 'autocomplete' => 'off', 'empty' => '&nbsp;'));

        echo CHtml::hiddenField('type', $type);

    $this->endWidget();

echo <<<HTML
<span id="spinner1"></span>
HTML;
