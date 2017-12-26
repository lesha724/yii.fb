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

                if($model->isNewRecord)
                {
                    $html .= $form->hiddenField($model, 'ustem2');

                    $label = $form->label($model, 'ustem4', $options);
                    //$label = CHtml::label(tt('Вставить после занятия №'),'Ustem_ustem4',$options);
                    $input = $form->textField($model, 'ustem4',array('min'=>1,'max'=>100));
                    $html .= sprintf($pattern, $label, $input);
                }else
                {
                    $label = $form->label($model, 'ustem4', $options);
                    $input = $form->textField($model, 'ustem4',array('readonly'=>true));
                    $html .= sprintf($pattern, $label, $input);
                }

                $res = CHtml::listData(Ustem::model()->getUstem7Arr(),'rz8','rz8_');
                $label = $form->label($model, 'ustem7', $options);
                $input = $form->dropDownList($model, 'ustem7',$res);
                $html .= sprintf($pattern, $label, $input);
				
                $label = $form->label($model, 'ustem3', $options);
                $input = $form->textField($model, 'ustem3');
                $html .= sprintf($pattern, $label, $input);

                $label = $form->label($model, 'ustem5', $options);
                $input = $form->textArea($model, 'ustem5',array('maxlength'=>Ustem::USTEM5_LENGHT));
                $html .= sprintf($pattern, $label, $input);

                $label = $form->label($model, 'ustem6', $options);
                $input = $form->dropDownList($model, 'ustem6', Ustem::model()->getUstem6Arr($model->ustem2));
                $html .= sprintf($pattern, $label, $input);

                $label = $form->label($model, 'ustem11', $options);
                $input = $form->dropDownList($model, 'ustem11', CHtml::listData($model->getUstem11Arr($model->ustem2),'nr30','k2'));
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
            <?=tt('Отмена')?>
        </button>

        <button class="btn btn-small btn-primary" id="save-theme">
            <i class="icon-ok"></i>
            <?=tt('Сохранить')?>
        </button>
    </div>
</div>
