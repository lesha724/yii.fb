<?php
    Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/filter_form/default/discipline_group_type.js', CClientScript::POS_HEAD);

    $getGroupUrl = Yii::app()->createAbsoluteUrl('/progress/getGroups');
    Yii::app()->clientScript->registerScript('getGroupUrl', <<<JS
        getGroupsUrl = "{$getGroupUrl}"
JS
    , CClientScript::POS_READY);

    $form=$this->beginWidget('CActiveForm', array(
        'id'=>'filter-form',
    ));
        //$disciplines = CHtml::listData(D::model()->getDisciplinesForJournal(), 'd1', 'name');
        $disciplines = CHtml::listData(D::model()->getDisciplinesForJournalPermition(), 'd1', 'name');
        $type_lesson=FilterForm::getTypesForJournal();
        //$groups = CHtml::listData(Gr::model()->getGroupsForJournal($model->discipline), 'group', 'name');
        $groups = CHtml::listData(Gr::model()->getGroupsForJournalPermition($model->discipline,$model->type_lesson), 'group', 'name');
        echo '<div>'.
                $form->label($model, 'discipline').
                $form->dropDownList($model, 'discipline', $disciplines, array('class'=>'chosen-select', 'autocomplete' => 'off', 'empty' => '&nbsp;')).
                $form->label($model, 'type_lesson').
                $form->dropDownList($model, 'type_lesson', $type_lesson, array('class'=>'chosen-select', 'autocomplete' => 'off', 'empty' => '&nbsp;')).
                $form->label($model, 'group').
                $form->dropDownList($model, 'group', $groups, array('class'=>'chosen-select', 'autocomplete' => 'off', 'empty' => '&nbsp;')).
                //CHtml::hiddenField('type', $type).
            '</div>';

    $this->endWidget();

echo <<<HTML
<span id="spinner1"></span>
HTML;
