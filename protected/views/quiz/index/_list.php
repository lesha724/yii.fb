<?php
/**
 * Created by PhpStorm.
 * User: neffa
 * Date: 17.11.2018
 * Time: 13:17
 */

/**
 * @var QuizController $this
 * @var TimeTableForm $model
 * @var Gr $group
 * @var $readOnly boolean
 */
$dataProvider=new CArrayDataProvider(St::model()->getOpprezByGroup($group->gr1),array(
    'sort'=>false,
    'pagination'=>false,
    'keyField' => 'st1'
));

$list=CHtml::listData(Opr::model()->findAll(), 'opr1', 'opr2');

$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'oprrez-list',
    'dataProvider' => $dataProvider,
    'filter' => null,
    'type' => 'striped bordered',
    'htmlOptions'=>array(
        'data-url' => Yii::app()->createUrl('quiz/create'),
        'data-pe-url' => Yii::app()->createUrl('quiz/updateFlur')
    ),
    'columns' => array(
        array(
            'header'=>Oprrez::model()->getAttributeLabel('oprrez2'),
            'value'=>'$data["pe2"] . " " . $data["pe3"] . " " . $data["pe4"]',
        ),
        array(
            'header'=>Oprrez::model()->getAttributeLabel('oprrez3'),
            'value'=>function($data) use (&$list){
                $select =  empty($data["oprrez"])? null : $data["oprrez"]->oprrez30->opr1;

                $html = '<div>';

                $html.= CHtml::dropDownList('oprrez-student-'.$data['st1'], $select, $list, array(
                    'data-st1'=>$data['st1'],
                    'class' => 'oprrez-select',
                    'prompt' => tt('--Выберите вариант--')
                ));

                $html .= '<div>';

                $person = Person::model()->findByPk($data['st200']);

                $html .= '<div>';
                $html .= '<div class="span3">';
                $html .= CHtml::label($person->getAttributeLabel('pe65'), 'pe65-student-'.$data['st1']);
                $html .= CHtml::dateField('pe65-student-'.$data['st1'], empty($person->pe65) ? null : date('Y-m-d', strtotime($person->pe65)), array(
                    'data-pe1'=>$data['st200'],
                    'data-field'=>'pe65',
                    'class' => 'pe-input'
                ));
                $html .= '</div>';
                $html .= '<div class="span3">';
                $html .= CHtml::label($person->getAttributeLabel('pe66'), 'pe65-student-'.$data['st1']);
                $html .= CHtml::textField('pe66-student-'.$data['st1'], $person->pe66, array(
                    'data-pe1'=>$data['st200'],
                    'data-field'=>'pe66',
                    'class' => 'pe-input'
                ));
                $html .= '</div>';
                $html .= '<div class="span6">';
                $html .= CHtml::label($person->getAttributeLabel('pe67'), 'pe65-student-'.$data['st1']);
                $html .= CHtml::textField('pe67-student-'.$data['st1'], $person->pe67, array(
                    'data-pe1'=>$data['st200'],
                    'data-field'=>'pe67',
                    'class' => 'pe-input'
                ));
                $html .= '</div>';
                $html .= '</div>';

                return $html;
            },
            'type'=>'raw',
        ),
        array(
            'header'=>Oprrez::model()->getAttributeLabel('oprrez4'),
            'value'=>function($data){
                if(empty($data["oprrez"]))
                    return '';
                return date("d.m.Y H:i:s", strtotime($data["oprrez"]->oprrez4));
            },
        ),
        array(
            'header'=>Oprrez::model()->getAttributeLabel('oprrez5'),
            'value'=>function($data){
                if(empty($data["oprrez"]))
                    return '';
                return $data["oprrez"]->oprrez50->name;
            },
        ),
    ),
));

Yii::app()->clientScript->registerCss('oprrez-select', <<<CSS
    .oprrez-select{
        margin-bottom: 0px;
        width: 100%;
    }
CSS
);
