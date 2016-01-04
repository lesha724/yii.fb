<?php
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

   
    $form=$this->beginWidget('CActiveForm', array(
        'id'=>'retake-form',
        'htmlOptions' => array('class' => 'form-horizontal')
    ));
    $html = '<div>';
    $html .= $form->errorSummary($model, null, null, array('class' => 'alert alert-error'));
    
    $input = $form->hiddenField($model, 'elgotr1');
    $html .= $input;
    if($us4!=1)
    {
        $label = $form->label($model, 'elgotr2', $options);
        $input = $form->textField($model, 'elgotr2');
        $html .= sprintf($pattern, $label, $input);
    }else
    {
        $label = $form->label($model, 'elgotr2', $options);
        $input = $form->dropDownList($model, 'elgotr2',Elgotr::model()->getElgotr2ArrByLk());
        $html .= sprintf($pattern, $label, $input);
    }

    $label = $form->label($model, 'elgotr3', $options);
    $input = $form->textField($model, 'elgotr3',array('class' => 'datepicker'));
    $html .= sprintf($pattern, $label, $input);

    $nr = Nr::model()->findByPk($r1);
    $k1=0;
    if(!empty($nr))
        $k1 = $nr->nr30;

    //$options_select = array('class'=>'chosen-select', 'autocomplete' => 'off', 'empty' => '&nbsp;', 'style' => 'width:200px');
    $teachers = CHtml::listData(P::model()->getTeachersForTimeTableChair($k1), 'p1', 'name');
    if(!empty($teachers)&&$k1!=0&&Yii::app()->user->dbModel->isJournalAdmin($k1,1,2)) {
        if (Yii::app()->user->isTch && isset($teachers[Yii::app()->user->dbModel->p1])) {
            $model->elgotr4 = Yii::app()->user->dbModel->p1;
        }
        $label = $form->label($model, 'elgotr4', $options);
        $input = $form->dropDownList($model, 'elgotr4', $teachers);
        $html .= sprintf($pattern, $label, $input);
    }else {
        $model->elgotr4 = Yii::app()->user->dbModel->p1;
        $html .= $form->hiddenField($model, 'elgotr4');
    }
    $html .= '</div>';
    echo $html;

    $this->endWidget();
?>
