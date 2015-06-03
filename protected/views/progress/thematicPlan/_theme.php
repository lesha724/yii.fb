<?php
/**
 *
 * @var ProgressController $this
 * @var Ustem $model
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

                /*$chairId  = K::model()->getChairByUo1($d1);
                $teachers = P::model()->getTeachersForTimeTable($chairId, 'pd1');
                $label = $form->label($model, 'groups', $options);
                $input = '';

                $groups = Gr::model()->getGroupsForThematicPlan($model->ustem1, $sem4);
                foreach ($groups as $group) {
                    $input .= $group['name'].' '.Chtml::dropDownList('Nr['.$group['nr1'].']', $group['nr6'], $teachers, array('class'=>'chosen-select', 'autocomplete' => 'off', 'empty' => array('&nbsp;'))).'<br/>';
                    $model->nr18 = $group['nr18'];
                }
                $html .= sprintf($pattern, $label, $input);*/
				$label = $form->label($model, 'ustem4', $options);
                $input = $form->textField($model, 'ustem4');
                $html .= sprintf($pattern, $label, $input);
				
                $label = $form->label($model, 'ustem3', $options);
                $input = $form->textField($model, 'ustem3');
                $html .= sprintf($pattern, $label, $input);

                $label = $form->label($model, 'ustem5', $options);
                $input = $form->textArea($model, 'ustem5');
                $html .= sprintf($pattern, $label, $input);

                /*$label = $form->label($model, 'nr18', $options);
                $input = $form->textField($model, 'nr18');
                $html .= sprintf($pattern, $label, $input);*/

                $label = $form->label($model, 'ustem6', $options);
                $input = $form->dropDownList($model, 'ustem6', array(tt('Занятие'), tt('Субмодуль')));
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
