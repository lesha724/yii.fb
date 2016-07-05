<?php
/**
 *
 * @var DefaultController $this
 * @var St $model
 *
 */
$this->pageHeader=tt('Родители');
$this->breadcrumbs=array(
    tt('Админ. панель'),
);
?>

<?php
$provider = $model->getParentsForAdmin();
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'parents',
    'dataProvider' => $provider,
    'filter' => $model,
    'type' => 'striped bordered',
    'ajaxUrl' => Yii::app()->createAbsoluteUrl('/admin/default/parents'),
    'columns' => array(
        'st2',
        'st3',
        'st4',
        array(
            'header' => 'Login',
            'filter' => CHtml::textField('login', Yii::app()->request->getParam('login')),
            'name'   => 'parentsAccount.u2',
            'value'  => '! empty($data->parentsAccount)
                                ? $data->parentsAccount->u2
                                : ""',
        ),
        /*array(
            'header' => 'Password',
            'filter' => CHtml::textField('password', Yii::app()->request->getParam('password')),
            'name'   => 'parentsAccount.u3',
            'value'  => '! empty($data->parentsAccount)
                                ? $data->parentsAccount->u3
                                : ""',
        ),*/
        array(
            'class'=>'CButtonColumn',
            'template'=>'{grants} {enter}',
            'header' => tt('Настройки'),
            'buttons'=>array
            (
                'grants' => array(
                    'label'=>'<i class="icon-check bigger-120"></i>',
                    'imageUrl'=>false,
                    'url'=>'Yii::app()->createAbsoluteUrl("/admin/default/prntGrants", array("id" => $data->st1))',
                    'options' => array('class' => 'btn btn-mini btn-success'),
                ),
                'enter' => array(
                    'label'=>'<i class="icon-share bigger-120"></i>',
                    'imageUrl'=>false,
                    'url'=>'Yii::app()->createAbsoluteUrl("/admin/default/enter", array("id" => !empty($data->account)? $data->account->u1: "-1"))',
                    'options' => array('class' => 'btn btn-mini btn-primary'),
                    'visible'=>'!empty($data->account)'
                ),
            ),
        ),
    ),
));
