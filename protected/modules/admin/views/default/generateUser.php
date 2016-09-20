<?php
/**
 * Created by PhpStorm.
 * User: Neff
 * Date: 20.09.2016
 * Time: 20:10
 */

$this->pageHeader=tt('Генерация пользователей');
$this->breadcrumbs=array(
    tt('Генерация пользователей'),
);
?>

<div class="span8">
    <blockquote>
        <p><?=tt('Поиск людей')?></p>
        <small><?=tt('Выберите людей')?></small>
    </blockquote>

    <?php
    $pageSize=Yii::app()->user->getState('pageSize',10);
    $this->widget('bootstrap.widgets.TbGridView',array(
        'id'=>'user-grid',
        'dataProvider'=>$model->search(),
        'filter'=>$model,
        'type'=>'striped hover bordered',
        'rowHtmlOptionsExpression' => 'array("data-id"=>$data["id"], "data-type"=>$data["type"])',
        'columns'=>array(
            'firstName'=>array(
                'name'=>'firstName',
                'value'=>function($data) {
                    return $data['first_name'];
                },
            ),
            'secondName'=>array(
                'name'=>'secondName',
                'value'=>function($data) {
                    return $data['second_name'];
                },
            ),
            'lastName'=>array(
                'name'=>'lastName',
                'value'=>function($data) {
                    return $data['last_name'];
                },
            ),
            'bDate'=>array(
                'name'=>'bDate',
                'value'=>function($data) {
                    return date_format(date_create_from_format('Y-m-d H:i:s', $data['b_date']), 'd-m-Y');
                },
            ),
            'type'=>array(
                'name'=>'type',
                'value'=>function($data) {
                    return GenerateUserForm::getType($data['type']);
                },
                'filter'=>GenerateUserForm::getTypes(),
            ),
            array(
                'class'=>'bootstrap.widgets.TbButtonColumn',
                'template'=>'{check}',
                'header'=>CHtml::dropDownList(
                    'pageSize',
                    $pageSize,
                    $this->getPageSizeArray(),
                    array('class'=>'change-pageSize','style'=>'max-width:70px')
                ),
                'buttons'=>array(
                    'check'=>array(
                        'label'=>'<i class="icon-check bigger-120"></i>',
                        'imageUrl'=>false,
                        'options' => array(
                            'class' => 'btn btn-mini btn-success',
                            'title'=>tt('Выбрать'),
                            'data-type'=>'$data["type"]',
                            'data-id'=>'$data["id"]'
                        ),
                    )
                )
            ),
        ),
    ));

    Yii::app()->clientScript->registerScript('initPageSize',"
	   $(document).on('change','.change-pageSize', function() {
	        $.fn.yiiGridView.update('user-grid',{ data:{ pageSize: $(this).val() }})
	    });",CClientScript::POS_READY);
    ?>
</div>
<div class="span4">
    <blockquote>
        <p><?=tt('Пользователи для генерации')?></p>
        <small><?=tt('Нажмите сгенерировать')?></small>
    </blockquote>
</div>
