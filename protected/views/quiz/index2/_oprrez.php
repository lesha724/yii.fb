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
 * @var $oprrezList Oprrez[]
 */

echo CHtml::openTag('ul');

foreach ($oprrezList as $oprrez){
    echo '<li>'.$oprrez->oprrez30->opr2.': '. $oprrez->oprrez6.'</li>';
}

echo CHtml::closeTag('div');

$form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'cancel-quiz-form',
    'method' => 'post',
    'action' => Yii::app()->createUrl('/quiz/cancel')
));
$this->widget('bootstrap.widgets.TbButton', array(
    'buttonType'=>'submit',
    'type'=>'danger',

    'icon'=>'cancel',
    'label'=>tt('Отмена'),
    'htmlOptions'=>array(
        'class'=>'btn-small',
    )
));
$this->endWidget();