<?php
/**
 *
 * @var DefaultController $this
 * @var St $model
 *
 */
$this->pageHeader=tt('Студенты');
$this->breadcrumbs=array(
    tt('Админ. панель'),
);
?>

<?php
$provider = $model->getStudentsForAdmin();
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'students',
    'dataProvider' => $provider,
    'filter' => $model,
    'type' => 'striped bordered',
    'ajaxUrl' => Yii::app()->createAbsoluteUrl('/admin/default/students'),
    'columns' => array(
        'st2',
        'st3',
        'st4',
        'st15',
        array(
            'header' => 'Login',
            'filter' => CHtml::textField('login', Yii::app()->request->getParam('login')),
            'name' => 'account.u2',
            'value' => '! empty($data->account)
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
            'name' => 'account.u4',
            'value' => '! empty($data->account)
                                ? $data->account->u4
                                : ""',
        ),
        array(
            'class'=>'CButtonColumn',
            'template'=>'{grants}',
            'header' => tt('Настройки'),
            'buttons'=>array
            (
                'grants' => array(
                    'label'=>'<i class="icon-check bigger-120"></i>',
                    'imageUrl'=>false,
                    'url'=>'Yii::app()->createAbsoluteUrl("/admin/default/StGrants", array("id" => $data->st1))',
                    'options' => array('class' => 'btn btn-mini btn-success'),
                ),
            ),
        ),
    ),
));
