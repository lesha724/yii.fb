<?php
/**
 *
 * @var DefaultController $this
 * @var SearchStudents $model
 *
 */
$this->pageHeader=tt('Родители');
$this->breadcrumbs=array(
    tt('Админ. панель'),
);
?>

<?php
$template = <<<HTML
            <div>
                <div class="pull-left">{summary}</div>
                <div class="pull-right">{pager}</div>
            </div>
            {items}
            <div>
                <div class="pull-right">{pager}</div>
            </div>
HTML;

$provider = $model->getParentsForAdmin();
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'parents',
    'dataProvider' => $provider,
    'filter' => $model,
    'pager' => array(
        'firstPageLabel'=>'<<',
        'prevPageLabel'=>'<',
        'nextPageLabel'=>'>',
        'lastPageLabel'=>'>>',
        'class'=>'bootstrap.widgets.TbPager',
        'displayFirstAndLast'=>true
    ),
    'template' => $template,
    'type' => 'striped bordered',
    'ajaxUrl' => Yii::app()->createUrl('/admin/default/parents'),
    'columns' => array(
        array(
            'name' => 'st2',
            'value' => '$data->person->pe2',
        ),
        array(
            'name' => 'st3',
            'value' => '$data->person->pe3',
        ),
        array(
            'name' => 'st4',
            'value' => '$data->person->pe4',
        ),
        array(
            'name' => 'st15',
            'value' => '$data->person->pe20',
        ),
        array(
            'header' => 'Login',
            'filter' => CHtml::textField('login', Yii::app()->request->getParam('login')),
            'name' => 'parentsAccount.u2',
            'value' => '! empty($data->parentsAccount)
                                ? $data->parentsAccount->u2
                                : ""',
        ),
        array(
            'header' => 'Email',
            'filter' => CHtml::textField('email', Yii::app()->request->getParam('email')),
            'name' => 'parentsAccount.u4',
            'value' => '! empty($data->parentsAccount)
                                ? $data->parentsAccount->u4
                                : ""',
        ),
        'st_status'=>array(
            'name'=>'st_status',
            'header' => 'Статус обучения',
            'type'=>'raw',
            'filter' => array(
                '1'=>tt("Активный"),
                '2'=>tt("Выпущен")
            ),
            'value'=>' !in_array($data["st_status"],array(4,2)) ? "<label class=\'label label-success\'>".tt("Активный")."</label>" : "<label class=\'label\'>".tt("Выпущен")."</label>"'
        ),
        array(
            'class'=>'CButtonColumn',
            'template'=>'{grants} {enter} {delete}',
            'header' => tt('Настройки'),
            'buttons'=>array
            (
                'grants' => array(
                    'label'=>'<i class="icon-check bigger-120"></i>',
                    'imageUrl'=>false,
                    'url'=>'Yii::app()->createUrl("/admin/default/prntGrants", array("id" => $data->st1))',
                    'options' => array(
                        'class' => 'btn btn-mini btn-success',
                        'title'=>tt('Редактировать'),
                    ),
                ),
                'enter' => array(
                    'label'=>'<i class="icon-share bigger-120"></i>',
                    'imageUrl'=>false,
                    'url'=>'Yii::app()->createUrl("/admin/default/enter", array("id" => !empty($data->parentsAccount)? $data->parentsAccount->u1: "-1"))',
                    'options' => array(
                        'class' => 'btn btn-mini btn-primary',
                        'title'=>tt('Авторизироваться'),
                    ),
                    'visible'=>'!empty($data->parentsAccount)'
                ),
                'delete' => array(
                    'label'=>'<i class="icon-trash bigger-120"></i>',
                    'imageUrl'=>false,
                    'url'=>'Yii::app()->createUrl("/admin/default/deleteUser", array("id" => !empty($data->parentsAccount)? $data->parentsAccount->u1: "-1"))',
                    'options' => array(
                        'class' => 'btn btn-mini btn-danger',
                        'title'=>tt('Удалить'),
                    ),
                    'visible'=>'!empty($data->parentsAccount)'
                ),
            ),
        ),
    ),
));
