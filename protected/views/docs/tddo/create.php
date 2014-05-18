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
/**
 *
 * @var DocsController $this
 */
$docType = $model->tddo2;

$this->pageHeader=tt('Добавить документ');
$this->breadcrumbs=array(
    tt('Док.-оборот') => Yii::app()->createUrl('docs/farm', array('docType' => $docType)),
    Ddo::model()->findByPk($docType)->getAttribute('ddo2')
);
Yii::app()->clientScript->registerPackage('jquery.ui');
Yii::app()->clientScript->registerPackage('datepicker');
Yii::app()->clientScript->registerPackage('autosize');

Yii::app()->clientScript->registerPackage('chosen');

Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/docs/farm.js', CClientScript::POS_HEAD);

$getTddoNextNumberUrl = Yii::app()->createUrl('docs/getTddoNextNumber');
Yii::app()->clientScript->registerScript('variables', <<<JS
   getTddoNextNumberUrl = '{$getTddoNextNumberUrl}';
   docType = '{$docType}';
JS
    ,CClientScript::POS_READY);

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

            // Input registration number mannualy
            if (Yii::app()->params['code'] == U_NULAU && $docType != 1) {
                $label = $form->label($model, 'tddo3', $labelOptions);
                $input = $form->textField($model, 'tddo3');
                $html .= sprintf($pattern, $label, $input);
            }


            // Enter date
            $label = $form->label($model, 'tddo4', $labelOptions);
            $input = $form->textField($model, 'tddo4', array('class' => 'datepicker'));
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
                $input = $form->textField($model, 'tddo9', array('class' => 'datepicker'));
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
                    $values = array(Tddo::ONLY_INDEXES => tt('Индескы').' ');
                } else {
                    $values = array(Tddo::ONLY_TEACHERS => tt('Преподаватель').' ', Tddo::ONLY_CHAIRS => tt('Кафедра').' / '.tt('Отдел'));
                }

                $options = array('separator' => '', 'labelOptions' => array('style' => 'display:inline'));
                $input = $form->radioButtonList($model, 'executorType', $values, $options);
                $html .= sprintf($pattern, $label, $input);

                $input = CHtml::link(tt('Добавить исполнителя'), Yii::app()->createUrl('#'), array('id' => 'addNewExecutor'));
                $html .= sprintf($pattern, '', $input);
            }

            // execution control
            if ($docType >= 5) {
                $label = $form->label($model, 'tddo10', $labelOptions);
                $input = $form->checkBox($model, 'tddo10');
                $html .= sprintf($pattern, $label, $input);
            }

            if (in_array($docType, array(1,3,4))) {
                $label = $form->label($model, 'executionDates', $labelOptions);
                $input = CHtml::link(tt('Добавить дату'), Yii::app()->createUrl('#'), array('id' => 'addNewExecutionDate'));
                $html .= sprintf($pattern, $label, $input);
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