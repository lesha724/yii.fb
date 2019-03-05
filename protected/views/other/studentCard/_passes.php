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
Yii::app()->clientScript->registerPackage('gritter');

$passList = $st->getPass();

$dataProvider=new CArrayDataProvider($passList,array(
    'sort'=>false,
    'pagination'=>false,
    'keyField' => 'elgp0'
));

$list=CHtml::listData(Opr::model()->findAll(), 'opr1', 'opr2');

$this->widget('bootstrap.widgets.TbButton', array(
    'buttonType'=>'link',
    'type'=>'primary',
    'icon'=>'plus',
    'label'=>tt('Создать заявку на оплату'),
    'htmlOptions'=>array(
        'class'=>'btn-mini',
        'id'=>'studentCard-create-request'
    )
));

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
            'selectableRows'=>100,
            'disabled' => function($data){
                /*if($data['otrabotal'] == 1)
                    return true;*/

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
            'type' => 'raw',
            'value'=>'$data["otrabotal"] == 0 ? "<label class=\'label label-warning\'>-</label>" : "<label class=\'label label-success\'>+</label>"',
        ),

        array(
            'header'=>tt('Номер справки'),
            'value'=>'$data["rpspr4"]',
        ),
    ),
));

$url = Yii::app()->createUrl('/other/createRequestPayment');


Yii::app()->clientScript->registerScript('create-request-payment', <<<JS
    $('#studentCard-create-request').click(function(){
        alert(1);
        var keys = $.fn.yiiGridView.getChecked("passes-list","selectedIds");
        
        if (!keys || keys.length ==0) {
            addGritter('','Выберите пропуски', 'error')
            return;
        }
        
        $.ajax({
            url: '{$url}', 
            type: 'POST',
            data:{
                lessons:keys
            },
            success: function( data ) {
                window.location.reload();
            },
            error:function(jqXHR, textStatus, errorThrown) {
                if (jqXHR.status == 500) {
                    addGritter('','Internal error: ' + jqXHR.responseText, 'error')
                } else {
                    if (jqXHR.status == 403) {
                        addGritter('','Access error: ' + jqXHR.responseText, 'error')
                    } else {
                        addGritter('','Unexpected error: ' + jqXHR.responseText, 'error')
                    }
                }
            },
        });
    });
JS
    , CClientScript::POS_END);

