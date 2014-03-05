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
$provider = $model->getStudents();
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
    ),
));
