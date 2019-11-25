<?php
/**
 *
 * @var DefaultController $this
 * @var SearchStudents $model
 *
 */
$this->pageHeader=tt('Студенты');
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

$pageSize=Yii::app()->user->getState('pageSize',10);
$provider = $model->getStudentsForAdmin();
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'students',
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
    'ajaxUrl' => Yii::app()->createAbsoluteUrl('/admin/default/students'),
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
            'name' => 'account.u2',
            'value' => '! empty($data->account)
                                ? $data->account->u2
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
        'gr3'=>array(
            'name'=>'gr3',
            'value'=>'$data->getGroupName()'
        ),
        array(
            'class'=>'CButtonColumn',
            'template'=>'{st165} {grants} {enter} {delete} ',
            //'header' => tt('Настройки'),
            'header'=>CHtml::dropDownList(
                    'pageSize',
                    $pageSize,
                    SH::getPageSizeArray(),
                    array('class'=>'change-pageSize')
                ),
            'buttons'=>array
            (
                'st165' => array(
                    'label'=>'<i class="icon-info-sign bigger-120"></i>',

                    'imageUrl'=>false,
                    'url'=>'Yii::app()->createAbsoluteUrl("/admin/default/st165", array("id" => $data->st1))',
                    'options' => array(
                        'class' => 'btn btn-mini btn-info',
                        'title'=>tt('Добавить общую информацию'),
                    ),
                ),
                'grants' => array(
                    'label'=>'<i class="icon-check bigger-120"></i>',

                    'imageUrl'=>false,
                    'url'=>'Yii::app()->createAbsoluteUrl("/admin/default/StGrants", array("id" => $data->st1))',
                    'options' => array(
                        'class' => 'btn btn-mini btn-success',
                        'title'=>tt('Редактировать'),
                    ),
                ),
                'enter' => array(
                    'label'=>'<i class="icon-share bigger-120"></i>',
                    'imageUrl'=>false,
                    'url'=>'Yii::app()->createAbsoluteUrl("/admin/default/enter", array("id" => !empty($data->account)? $data->account->u1: "-1"))',
                    'options' => array(
                        'class' => 'btn btn-mini btn-primary',
                        'title'=>tt('Авторизироваться'),
                    ),
                    'visible'=>'!empty($data->account)'
                ),

                'delete' => array(
                    'label'=>'<i class="icon-trash bigger-120"></i>',
                    'imageUrl'=>false,
                    'url'=>'Yii::app()->createAbsoluteUrl("/admin/default/deleteUser", array("id" => !empty($data->account)? $data->account->u1: "-1"))',
                    'options' => array(
                        'class' => 'btn btn-mini btn-danger',
                        'title'=>tt('Удалить'),
                    ),
                    'visible'=>'!empty($data->account)'
                ),
            ),
        ),
    ),
));

Yii::app()->clientScript->registerScript('initPageSize',"
	   $(document).on('change','.change-pageSize', function() {
	        $.fn.yiiGridView.update('students',{ data:{ pageSize: $(this).val() }})
	    });",CClientScript::POS_READY);
?>
