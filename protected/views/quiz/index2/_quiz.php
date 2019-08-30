<?php
/**
 * Created by PhpStorm.
 * User: Lesha
 * Date: 30.08.2019
 * Time: 12:06
 */

/**
 * @var $this QuizController
 * @var $st St
 */

Yii::app()->clientScript->registerCss('opr-style', <<<CSS
    .opr-block>.mark-block>.mark-title>div{
        float: left;
        width: 33.333%;
    }
    .mark-block{
        float: left;
    }
CSS
);

$maxMark =  (int)PortalSettings::model()->getSettingFor(PortalSettings::MAX_MARK_QUIZ);

$marks = array();
for($i=1; $i<=$maxMark; $i++)
    $marks[$i] = $i;

$oprList = Opr::model()->findAll();

$form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'quiz-form',
    'method' => 'post',
    'action' => Yii::app()->createUrl('/quiz/save')
)); ?>
        <div class="opr-list">
        <?php
        foreach ($oprList as $opr){
            $radioButtonList = CHtml::radioButtonList('answers['.$opr->opr1.']', 1, $marks, array(
                'labelOptions'=>array('style'=>'display:inline; margin-right:30px'),
                'separator' => ''
            ));

            echo <<<HTML
                <div class="opr-block row-fluid">
                    <p>{$opr->opr2}</p>
                    <div class="mark-block">
                        <div class="marks">
                            $radioButtonList
                        </div>
                        <div class="mark-title">
                          <div class="text-left"><span class="label label-important">{$opr->opr3}</span></div>
                          <div class="text-center"><span class="label label-yellow">{$opr->opr4}</span></div>
                          <div class="text-right"><span class="label label-success">{$opr->opr5}</span></div>
                        </div>
                    </div>
                </div>
HTML;
        }
        ?>
        </div>

<?php

$this->widget('bootstrap.widgets.TbButton', array(
    'buttonType'=>'submit',
    'type'=>'success',

    'icon'=>'ok',
    'label'=>tt('Сохранить'),
    'htmlOptions'=>array(
        'class'=>'btn-small',
    )
));

$this->endWidget();