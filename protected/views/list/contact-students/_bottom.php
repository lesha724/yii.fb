<?php
/**
 * @var ListController $this
 * @var FilterForm $model
 */

    $dataProvider=new CArrayDataProvider(St::model()->getStudentsOfGroup($model->group),array(
        'sort'=>false,
        'pagination'=>false,
        'keyField' => 'st1'
    ));

$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'students-list',
    'dataProvider' => $dataProvider,
    'filter' => null,
    'type' => 'striped bordered',
    'columns' => array(
        array(
            'header'=>tt('ФИО'),
            'value'=>function($data){
                /**
                 * @var $data St
                 */
                return $data->fullName;
            },
        ),
        array(
            'header'=>tt('Логин Skype'),
            'type' => 'raw',
            'value'=>function($data){
                /**
                 * @var $data St
                 */
                if(empty($data->st107))
                    return '';
                return CHtml::link(
                    $data['st107'],
                    'skype:'.$data->st107.'?chat'
                );
            },
        )
    ),
));
