<?php
/**
 * Created by PhpStorm.
 * User: neffa
 * Date: 07.12.2018
 * Time: 17:10
 */

/**
 * @var $st St
 */

/**
 * @var $passList array
 * @var $this OtherController
 */

$dataProvider=new CArrayDataProvider($passList,array(
    'sort'=>false,
    'pagination'=>false,
    'keyField' => 'elgp0'
));

$list=CHtml::listData(Opr::model()->findAll(), 'opr1', 'opr2');

$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'passes-list',
    'dataProvider' => $dataProvider,
    'filter' => null,
    'type' => 'striped bordered',
    'columns' => array(
        array(
            'id' => 'selectedIds',
            'value' => '$data["elgp0"]',
            'class' => 'CCheckBoxColumn',
            'disabled' => function($data){
                if($data['otrabotal'] == 1)
                    return true;

                if(!empty($data['RPSPR0']))
                    return true;

                return false;
            }
        ),
        array(
            'header'=>tt('Кафедра'),
            'value'=>'$data["k2"]',
        ),
        array(
            'header'=>tt('Дисциплина'),
            'value'=>'$data["d2"]',
        ),
        array(
            'header'=>tt('Дата занятия'),
            'value'=>function($data){
                if(empty($data["r2"]))
                    return '';
                return date("d.m.Y", strtotime($data["r2"]));
            },
        ),
        array(
            'header'=>tt('Номер занятия'),
            'value'=>'$data["elgz3"]',
        ),
        array(
            'header'=>tt('Группа'),
            'value'=>function($data){
                if(!empty($data['virt_grup']))
                    return $data['virt_grup'];
                return $data['gr3'];
            },
        ),
        array(
            'header'=>tt('Длительность занятия'),
            'value'=>'round($data["ustem7"], 2)',
        ),
        array(
            'header'=>tt('Тип занятия'),
            'value'=>'SH::convertTypeJournal($data["elg4"])',
        ),
        array(
            'header'=>tt('Стоимость'),
            'value'=>'round($data["stoimost"], 2)',
        ),
        array(
            'header'=>tt('Отработка'),
            'value'=>'$data["otrabotal"] == 0 ? "-" : "+"',
        ),

        array(
            'header'=>tt('Номер справки'),
            'value'=>'$data["rpspr4"]',
        ),
    ),
));
