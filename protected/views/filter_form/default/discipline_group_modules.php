<?php
    Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/filter_form/default/discipline_group_modules.js', CClientScript::POS_HEAD);

    $form=$this->beginWidget('CActiveForm', array(
        'id'=>'filter-form',
        'htmlOptions' => array('class' => 'form-inline row-fluid')
    ));
        $disciplines = CHtml::listData(D::model()->getDisciplinesForModulesPermition(), 'd1', 'd2');
        $groups = CHtml::listData(Gr::model()->getGroupsForJournalPermition($model->discipline,$model->type_lesson), 'group', 'name');
        $modules=FilterForm::getTypesForJournal();

        $options =  array('class'=>'chosen-select', 'autocomplete' => 'off', 'empty' => '&nbsp;');
        echo '<div>'.
                '<div class="span3 ace-select">'.
                $form->label($model, 'discipline').
                $form->dropDownList($model, 'discipline', $disciplines,$options).
                '</div>'.
                '<div class="span3 ace-select">'.
                $form->label($model, 'group').
                $form->dropDownList($model, 'group', $groups,$options).
                '</div>'.
                '<div class="span3 ace-select">'.
                $form->label($model, 'module').
                $form->dropDownList($model, 'module', $modules, array('class'=>'chosen-select', 'autocomplete' => 'off', 'empty' => '&nbsp;')).
                '</div>'.
            '</div>';

    $this->endWidget();

echo <<<HTML
<span id="spinner1"></span>
HTML;
