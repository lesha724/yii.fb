<?php
/**
 * Created by PhpStorm.
 * User: Neff
 * Date: 07.12.2015
 * Time: 18:52
 */

    $this->pageHeader=tt('Закрытия портала для кафедры');
    $this->breadcrumbs=array(
        tt('Закрытия портала для кафедры'),
    );

    $this->menu=array(
        array('label'=>tt('Добавить'),'icon'=>'plus','url'=>'#','linkOptions' => array('id'=>'create-kcp')),
    );

    if(!empty($this->menu))
    {
        echo $this->renderPartial('/default/_menu');
    }
?>

<?php
$pageSize=Yii::app()->user->getState('pageSize',10);
$this->widget('bootstrap.widgets.TbGridView',array(
    'id'=>'kcp-grid',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'type'=>'striped hover bordered',
    'columns'=>array(
        'kcp2'=>array(
            'name'=>'kcp2',
            'value'=>'$data->kcp20->k3',
        ),
        array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'template'=>'{delete}',
            'buttons'=>array(
                'delete'=>array(
                    'url'=>'array("deleteCloseChair","id"=>$data->kcp1)'
                )
            ),
            'header'=>CHtml::dropDownList(
                'pageSize',
                $pageSize,
                $this->getPageSizeArray(),
                array('class'=>'change-pageSize','style'=>'max-width:70px')
            ),
        ),
    ),
));
Yii::app()->clientScript->registerScript('initPageSize',"
	   $(document).on('change','.change-pageSize', function() {
	        $.fn.yiiGridView.update('kcp-grid',{ data:{ pageSize: $(this).val() }})
	    });",CClientScript::POS_READY);

Yii::app()->clientScript->registerScript('create-btn-kcp',"
	   $('#create-kcp').click(function(event) {
	        $('#myModal').modal('show');
	        event.preventDefault();
	    });",CClientScript::POS_READY);
?>

<?php
    $this->beginWidget(
    'bootstrap.widgets.TbModal',
        array(
            'id' => 'myModal',
        )
    ); ?>

    <div class="modal-header">
        <a class="close" data-dismiss="modal">&times;</a>
        <h4></h4>
    </div>

    <div class="modal-body">
        <?php
        $kcp = new Kcp();
        echo $this->renderPartial('closeChair/_create', array('model'=>$kcp)); ?>
    </div>
<?php $this->endWidget();
