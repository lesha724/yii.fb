<?php
/**
 *
 * @var ProgressController $this
 * @var Nr $model
 * @var CActiveForm $form
 */

$pattern = <<<HTML
<div class="control-group">
    %s
    <div class="controls">
        %s
    </div>
</div>
HTML;

$options = array(
    'class' => 'control-label'
);

?>

<div tabindex="-1" class="modal hide fade" id="modal-table" style="display: none;" aria-hidden="true">
    <div class="modal-header no-padding">
        <div class="table-header">
            <button data-dismiss="modal" class="close" type="button">×</button>
            <span><?=tt('Редактировать тему')?></span>
        </div>
    </div>

    <div class="modal-body no-padding">
        <div class="row-fluid">
            <?php
                /* @var CActiveForm $form */

                $html = '<div>';
                $form=$this->beginWidget('CActiveForm', array(
                    'id'=>'theme-form',
                    'htmlOptions' => array('class' => 'form-horizontal')
                ));
                $html .= $form->errorSummary($model, null, null, array('class' => 'alert alert-error'));

            $chairId  = K::model()->getChairByPd1($model->nr6);
            $teachers = P::model()->getTeachersForTimeTable($chairId, 'pd1');
            $label = $form->label($model, 'nr6', $options);
            $input = $form->dropDownList($model, 'nr6', $teachers, array('class'=>'chosen-select', 'autocomplete' => 'off', 'empty' => tt('&nbsp;')));
            $html .= sprintf($pattern, $label, $input);

                $label = $form->label($model, 'nr31', $options);
                $input = $form->textField($model, 'nr31');
                $html .= sprintf($pattern, $label, $input);

                $label = $form->label($model, 'nr32', $options);
                $input = $form->textField($model, 'nr32');
                $html .= sprintf($pattern, $label, $input);

                $label = $form->label($model, 'nr33', $options);
                $input = $form->textArea($model, 'nr33');
                $html .= sprintf($pattern, $label, $input);

                $label = $form->label($model, 'nr34', $options);
                $input = $form->dropDownList($model, 'nr34', array('Занятие', 'Субмодуль'));
                $html .= sprintf($pattern, $label, $input);



                $html .= '</div>';
                echo $html;

                $this->endWidget();
            ?>
        </div>
    </div>

    <div class="modal-footer">
        <button data-dismiss="modal" class="btn btn-small">
            <i class="icon-remove"></i>
            Cancel
        </button>

        <button class="btn btn-small btn-primary" id="save-theme">
            <i class="icon-ok"></i>
            <?=tt('Сохранить')?>
        </button>
    </div>
</div>
