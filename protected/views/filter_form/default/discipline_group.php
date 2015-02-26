<?php
    Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/filter_form/default/discipline_group.js', CClientScript::POS_HEAD);

    $getGroupUrl = Yii::app()->createAbsoluteUrl('/progress/getGroups');
    Yii::app()->clientScript->registerScript('getGroupUrl', <<<JS
        getGroupsUrl = "{$getGroupUrl}"
JS
    , CClientScript::POS_READY);

    $form=$this->beginWidget('CActiveForm', array(
        'id'=>'filter-form',
    ));
        $disciplines = CHtml::listData(D::model()->getDisciplines($type), 'd1', 'd2');
        $groups = CHtml::listData(Gr::model()->getGroupsFor($model->discipline, $type), 'gr1', 'name');

        echo '<div>'.
                $form->label($model, 'discipline').
                $form->dropDownList($model, 'discipline', $disciplines, array('class'=>'chosen-select', 'autocomplete' => 'off', 'empty' => '&nbsp;')).
                $form->label($model, 'group').
                $form->dropDownList($model, 'group', $groups, array('class'=>'chosen-select', 'autocomplete' => 'off', 'empty' => '&nbsp;')).
                CHtml::hiddenField('type', $type).
            '</div>';

    $this->endWidget();

echo <<<HTML
<span id="spinner1"></span>
HTML;
