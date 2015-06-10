<?php
	
    Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/filter_form/default/module.js', CClientScript::POS_HEAD);

    $getGroupUrl = Yii::app()->createAbsoluteUrl('/progress/getGroups');
    Yii::app()->clientScript->registerScript('getGroupUrl', <<<JS
        getGroupsUrl = "{$getGroupUrl}"
JS
    , CClientScript::POS_READY);

    $form=$this->beginWidget('CActiveForm', array(
        'id'=>'filter-form',
		'htmlOptions' => array('class' => 'form-inline')
    ));
		//$perm = P::getPerm();
		$chairs = CHtml::listData(Pd::model()->getChairs($type), 'pd4', 'k2');
		$streams = CHtml::listData(Sp::model()->getStreams(Yii::app()->session['year'],$model->chair), 'sg1',function($data){return $data['sp2'].'('.$data['sg3'].' '.$data['sem4'].'к.)';} );
		$disciplines = CHtml::listData(D::model()->getDisciplinesByStream($model->stream,$model->chair), 'uo1', 'd2');
		$modules = CHtml::listData(Sem::model()->getModule($model->discipline), 'vvmp1', 'vvmp6');
		$groups = CHtml::listData(Gr::model()->getGroupsByModule($model->discipline,$model->module), 'gr1', 'name');
		$statements=CHtml::listData(Gr::model()->getStatements($model->group,$model->module), 'vmpv1', 'vmpv3');
        echo '<div>'.
				'<div class="span3 ace-select">'.
				$form->label($model, 'chair').
                $form->dropDownList($model, 'chair', $chairs, array('class'=>'chosen-select', 'autocomplete' => 'off', 'empty' => '&nbsp;')).
                '</div>'.
				'<div class="span3 ace-select">'.
				$form->label($model, 'stream').
                $form->dropDownList($model, 'stream', $streams, array('class'=>'chosen-select', 'autocomplete' => 'off', 'empty' => '&nbsp;')).
				'</div>'.
				'<div class="span3 ace-select">'.
				$form->label($model, 'discipline').
                $form->dropDownList($model, 'discipline', $disciplines, array('class'=>'chosen-select', 'autocomplete' => 'off', 'empty' => '&nbsp;')).
                '</div>'.
				'<div class="span3 ace-select">'.
				$form->label($model, 'module').
                $form->dropDownList($model, 'module', $modules, array('class'=>'chosen-select', 'autocomplete' => 'off', 'empty' => '&nbsp;')).
				'</div>'.
				'<div class="span3 ace-select">'.
				$form->label($model, 'group').
                $form->dropDownList($model, 'group', $groups, array('class'=>'chosen-select', 'autocomplete' => 'off', 'empty' => '&nbsp;')).
                '</div>'.
				'<div class="span3 ace-select">'.
				$form->label($model, 'statement').
                $form->dropDownList($model, 'statement', $statements, array('class'=>'chosen-select', 'autocomplete' => 'off', 'empty' => '&nbsp;')).
				'</div>'.
				CHtml::hiddenField('type', $type).
            '</div>';

    $this->endWidget();
echo <<<HTML
<span id="spinner1"></span>
HTML;
