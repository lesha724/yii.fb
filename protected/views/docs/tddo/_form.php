<style>
    .ui-autocomplete {
        max-height: 200px;
        overflow-y: auto;
        /* prevent horizontal scrollbar */
        overflow-x: hidden;
    }
    /* IE 6 doesn't support max-height
    * we use height instead, but this forces the menu to always be this tall
    */
    * html .ui-autocomplete {
        height: 200px;
    }
    .ui-autocomplete-loading {
        background: white url('/images/ui-anim_basic_16x16.gif') right center no-repeat;
    }
</style>
<?php

$docType = $model->tddo2;

$getTddoNextNumberUrl = Yii::app()->createUrl('docs/getTddoNextNumber');
Yii::app()->clientScript->registerScript('variables', <<<JS
   getTddoNextNumberUrl = '{$getTddoNextNumberUrl}';
   docType = '{$docType}';
JS
    , CClientScript::POS_READY);

Yii::app()->clientScript->registerPackage('jquery.ui');
Yii::app()->clientScript->registerPackage('datepicker');
Yii::app()->clientScript->registerPackage('autosize');

Yii::app()->clientScript->registerPackage('chosen');

Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/docs/farm.js', CClientScript::POS_HEAD);

$pattern = <<<HTML
<div class="control-group">
    %s
    <div class="controls">
        %s
    </div>
</div>
HTML;

$labelOptions = array('class' => 'control-label');

?>

<div class="span12">
    <?php
    $html = '';
    $form=$this->beginWidget('CActiveForm', array(
        'id'=>'new-document',
        'htmlOptions' => array('class' => 'form-horizontal')
    ));

    $html .= $form->errorSummary($model, null, null, array('class' => 'alert alert-error'));


    // Input registration number
    if ($docType == 1 && Yii::app()->params['code'] === U_NULAU) {
        $label = $form->label($model, 'tddo12', $labelOptions);
        $input = $form->textField($model, 'tddo12');
    } else {
        $label = $form->label($model, 'tddo7', $labelOptions);
        $input = $form->textField($model, 'tddo7', array('disabled' => 'disabled'));
    }

    $html .= sprintf($pattern, $label, $input);

    // Input registration number manually
    if (Yii::app()->params['code'] == U_NULAU && $docType != 1) {
        $label = $form->label($model, 'tddo3', $labelOptions);
        $input = $form->textField($model, 'tddo3');
        $html .= sprintf($pattern, $label, $input);
    }


    // Enter date
    $label = $form->label($model, 'tddo4', $labelOptions);
    $input = $form->textField($model, 'tddo4Formatted', array('class' => 'datepicker', 'name' => 'Tddo[tddo4]'));
    $html .= sprintf($pattern, $label, $input);

    // Output registration number
    if ($docType == 1) {
        $label = $form->label($model, 'tddo8', $labelOptions);
        $input = $form->textField($model, 'tddo8');
        $html .= sprintf($pattern, $label, $input);
    }

    // Leave date
    if ($docType == 1) {
        $label = $form->label($model, 'tddo9', $labelOptions);
        $input = $form->textField($model, 'tddo9Formatted', array('class' => 'datepicker', 'name' => 'Tddo[tddo9]'));
        $html .= sprintf($pattern, $label, $input);
    }

    // organization
    $label = $form->label($model, 'tddo5', $labelOptions);
    $input = $form->textArea($model, 'tddo5', array('class' => 'autosize'));
    $html .= sprintf($pattern, $label, $input);


    // content
    $label = $form->label($model, 'tddo6', $labelOptions);
    $input = $form->textArea($model, 'tddo6', array('class' => 'autosize'));
    $html .= sprintf($pattern, $label, $input);


    // executors
    if (Tddo::showExecutorFor($docType)) {

        $label = $form->label($model, 'executorType', $labelOptions);

        if ($docType == 2) {
            $values = array(Tddo::ONLY_INDEXES => tt('Индексы').' ');
        } else {
            $values = array(Tddo::ONLY_TEACHERS => tt('Преподаватель').' ', Tddo::ONLY_CHAIRS => tt('Кафедра').' / '.tt('Отдел'));
        }

        $options = array('separator' => '', 'labelOptions' => array('style' => 'display:inline'));
        $input = $form->radioButtonList($model, 'executorType', $values, $options);
        $html .= sprintf($pattern, $label, $input);


        $addExecutorHtml = '';
        if (! $model->isNewRecord) {
            $executorPattern = <<<HTML
            <div>
                <input type="checkbox" class="%s" name="%s" %s />
                <input placeholder="%s" class="%s autocomplete" data-type="%s" value="%s" />
                <input type="hidden" name="%s" value="%s" />
              </div>
HTML;

            $teachers = Ido::model()->findAll('ido1='.$model->tddo1);
            foreach ($teachers as $teacher) {
                $pd1     = $teacher->ido2;
                $name    = P::model()->getTeacherNameByPd1($pd1);
                $checked = $teacher->ido5 == 1 ? 'checked="checked"' : '';

                $addExecutorHtml .= sprintf($executorPattern, 'teacher', 'ido5['.$pd1.']', $checked,tt('исполнитель'), 'teacher', Tddo::ONLY_TEACHERS, $name,'teachers[]', $pd1);
            }

            $chairs = Idok::model()->findAll('idok1='.$model->tddo1);
            foreach ($chairs as $chair) {
                $k1      = $chair->idok2;
                $name    = K::model()->findByPk($k1)->getAttribute('k3');
                $checked = $chair->idok4 == 1 ? 'checked="checked"' : '';

                $addExecutorHtml .= sprintf($executorPattern, 'chair', 'idok4['.$k1.']', $checked, tt('исполнитель'), 'chair', Tddo::ONLY_CHAIRS, $name,'chairs[]', $k1);
            }


            if (! $model->tddo2 == 2) {
                $indexPattern = <<<HTML
                <div>
                    <input placeholder="%s" class="%s autocomplete" data-type="%s" value="%s">
                    <input type="hidden" name="%s" value="%s">
                  </div>
HTML;
                $indexes = Ido::model()->findAll('ido1='.$model->tddo1);
                foreach ($indexes as $index) {
                    $innf1 = $index->ido4;
                    $indexModel = Innf::model()->findByPk($innf1);
                    $name = $indexModel->getAttribute('innf2').' '.$indexModel->getAttribute('innf3');
                    $addExecutorHtml .= sprintf($indexPattern, tt('исполнитель'), 'index', Tddo::ONLY_INDEXES, $name, 'indexs[]', $innf1);
                }
            }
        }
        $addExecutorHtml .= CHtml::link(tt('Добавить исполнителя'), Yii::app()->createUrl('#'), array('id' => 'addNewExecutor'));
        $html .= sprintf($pattern, '', $addExecutorHtml);
    }

    // execution control
    if ($docType >= 5) {
        $label = $form->label($model, 'tddo10', $labelOptions);
        $input = $form->checkBox($model, 'tddo10');
        $html .= sprintf($pattern, $label, $input);
    }

    if (in_array($docType, array(1,3,4))) {

        $addDateHtml = '';
        $datePattern = <<<HTML
<input class="datepicker input-medium" placeholder="%s" value="%s" name="Dkid[%s][dkid2]">
-
<input class="datepicker input-medium" placeholder="%s" value="%s" name="Dkid[%s][dkid3]">
<br>
HTML;

        $i = 0;
        $dates = Dkid::model()->findAll('dkid1='.$model->tddo1);
        foreach ($dates as $date) {
            $dkid2 = SH::formatDate('Y-m-d H:i:s', 'd.m.Y', $date['dkid2']);
            $dkid3 = SH::formatDate('Y-m-d H:i:s', 'd.m.Y', $date['dkid3']);
            $addDateHtml .= sprintf($datePattern, tt('Треб.дата'), $dkid2, $i, tt('Факт.дата'), $dkid3, $i);
            $i++;
        }

        $label = $form->label($model, 'executionDates', $labelOptions);
        $addDateHtml .= CHtml::link(tt('Добавить дату'), Yii::app()->createUrl('#'), array('id' => 'addNewExecutionDate'));
        $html .= sprintf($pattern, $label, $addDateHtml);
    }

    $buttons = <<<HTML
<div class="form-actions">
    <button type="submit" class="btn btn-info">
        <i class="icon-ok bigger-110"></i>
        %s
    </button>
</div>
HTML;

    $html .= sprintf($buttons, tt('Сохранить'));

    echo $html;

    $this->endWidget();
    ?>
</div>