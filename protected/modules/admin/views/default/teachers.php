<?php
/**
 *
 * @var DefaultController $this
 * @var P $model
 *
 */

    Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/admin/teachers.js', CClientScript::POS_HEAD);

    $this->pageHeader=tt('Преподаватели');
    $this->breadcrumbs=array(
        tt('Админ. панель'),
    );
?>
<?php

    $chairs = CHtml::listData(K::model()->getAllChairs(), 'k1', 'k3');
    //echo CHtml::label(tt('Кафедра'), 'chairs');
    echo CHtml::dropDownList('chairs', '', $chairs, array('class'=>'chosen-select', 'autocomplete' => 'off', 'empty' => ''));


    $provider = $model->getTeachersFor($chairId);
    $this->widget('bootstrap.widgets.TbGridView', array(
        'id' => 'teachers',
        'dataProvider' => $provider,
        'filter' => $model,
        'type' => 'striped bordered',
        'ajaxUrl' => Yii::app()->createAbsoluteUrl('/admin/default/teachers'),
        'columns' => array(
            'p3',
            'p4',
            'p5',
			'p9'=>array(
				'name' => 'p9',
				'value'=>'$data->getP9String()',
				'filter' => '',
				'htmlOptions' => array(
					'style' => 'min-width:130px;',
				),
			),
			'p13'=>array(
				'name' => 'p13',
				'filter' => '',
			),
            array(
                'header' => 'Login',
                'filter' => CHtml::textField('login', Yii::app()->request->getParam('login')),
                'name'   => 'account.u2',
                'value'  => '! empty($data->account)
                                ? $data->account->u2
                                : ""',
            ),
            array(
                'header' => 'Password',
                'filter' => CHtml::textField('password', Yii::app()->request->getParam('password')),
                'name'   => 'account.u3',
                'value'  => '! empty($data->account)
                                ? $data->account->u3
                                : ""',
            ),
            array(
                'header' => 'Email',
                'filter' => CHtml::textField('email', Yii::app()->request->getParam('email')),
                'name'   => 'account.u4',
                'value'  => '! empty($data->account)
                                ? $data->account->u4
                                : ""',
            ),
            array(
                'header' => tt('Статус'),
                'filter' => CHtml::dropDownList('status', Yii::app()->request->getParam('status'), array(''=>'',1=>tt('Администратор'))),
                'name'   => 'account.u7',
                'value'  => '! empty($data->account)
                                ? $data->account->u7 == 1 ? "<span class=\"label label-warning\">'.tt("Администратор").'</span>" : ""
                                : ""',
                'type'   => 'raw'
            ),
            array(
                'class'=>'CButtonColumn',
                'template'=>'{grants}',
                'header' => tt('Права доступа'),
                'buttons'=>array
                (
                    'grants' => array(
                        'label'=>'<i class="icon-check bigger-120"></i>',
                        'imageUrl'=>false,
                        'url'=>'Yii::app()->createAbsoluteUrl("/admin/default/PGrants", array("id" => $data->p1))',
                        'options' => array('class' => 'btn btn-mini btn-success'),
                    ),
                ),
            ),
        ),
    ));

