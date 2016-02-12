<?php
    Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/filter_form/default/discipline_group_type.js', CClientScript::POS_HEAD);

    $getGroupUrl = Yii::app()->createAbsoluteUrl('/progress/getGroups');
    Yii::app()->clientScript->registerScript('getGroupUrl', <<<JS
        getGroupsUrl = "{$getGroupUrl}"
JS
    , CClientScript::POS_READY);

    $form=$this->beginWidget('CActiveForm', array(
        'id'=>'filter-form',
        'htmlOptions' => array('class' => 'form-inline row-fluid')
    ));
        $options =  array('class'=>'chosen-select', 'autocomplete' => 'off', 'empty' => '&nbsp;');
        $disciplines = CHtml::listData(D::model()->getDisciplinesForTPlanPermition(), 'd1', 'd2');
        $groups = CHtml::listData(Gr::model()->getGroupsForTPlanPermition($model->discipline), 'group', 'name');
        echo '<div>'.
                '<div class="span6 ace-select w400">'.
                $form->label($model, 'discipline').
                $form->dropDownList($model, 'discipline', $disciplines,$options).
                '</div>'.
                '<div class="span6 ace-select w400">'.
                CHtml::label(tt('Поток'),'FilterForm_group').
                $form->dropDownList($model, 'group', $groups,$options).
                '</div>'.
            '</div>';

    $this->endWidget();

/*echo <<<HTML
<span id="spinner1"></span>
HTML;*/
