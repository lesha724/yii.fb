<?php
/* @var $this DistEducationController */
/* @var $model DistEducationFilterForm */
?>
    <style>
        #chosen_dispdist3_chosen{
            width: 100%!important;
        }
    </style>
<?php
$pageSize=Yii::app()->user->getState('pageSize',10);
if($pageSize==0)
    $pageSize=10;

$params = array();
if($model->isAdminDistEducation)
    $params = array('chairId'=>$model->chairId);

$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'disp-list',
    'dataProvider' => $model->getDispListForDistEducation(),
    'filter' => $model,
    'type' => 'striped bordered',
    'ajaxUrl' => Yii::app()->createAbsoluteUrl('/distEducation/index', $params),
    'columns' => array(
        'd2'=>array(
            'name'=>'d2',
            'header'=>$model->getAttributeLabel('d2'),
            'value'=>'$data["d2"]',
        ),
        'course'=>array(
            'name'=>'course',
            'header'=>$model->getAttributeLabel('course'),
            'value'=>'$data["sem4"]',
        ),
        'sp2'=>array(
            'name'=>'sp2',
            'header'=>$model->getAttributeLabel('sp2'),
            'value'=>'$data["sp2"]',
        ),
        'distDisp'=>array(
            'header'=>tt('Курс'),
            'value'=>'$data["dispdist2"]." ".$data["dispdist3"]',
        ),
        array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'template'=>'{update} {reset}',
            'header'=>CHtml::dropDownList(
                'pageSize',
                $pageSize,
                array(5=>5,10=>10,20=>20,50=>50,100=>100),
                array('class'=>'change-pageSize')
            ),
            'buttons'=>array
            (
                'reset' => array(
                    'label'=>tt('Отменить привязку'),
                    'icon'=>'icon-remove bigger-120',
                    'url'=>'array("removeLink","uo1"=>$data["uo1"],"k1"=>$data["uo4"])',
                    'options' => array('class' => 'btn btn-mini btn-danger btn-remove-link'),
                    'visible'=>'!empty($data["dispdist3"])'
                ),
                'update' => array(
                    'label'=>tt('Добавить привязку'),
                    'icon'=>'icon-plus bigger-120',
                    'url'=>'array("addLink","uo1"=>$data["uo1"],"k1"=>$data["uo4"])',
                    'options' => array('class' => 'btn btn-mini btn-warning btn-add-link'),
                    'visible'=>'empty($data["dispdist3"])'
                )
            ),
        ),
    ),
));

Yii::app()->clientScript->registerScript('initPageSize',"           
        $(document).on('change','.change-pageSize', function() {
            $.fn.yiiGridView.update('disp-list',{ data:{ pageSize: $(this).val() }})
	    });",CClientScript::POS_READY);

$this->beginWidget(
    'bootstrap.widgets.TbModal',
    array(
        'id' => 'myModal',
        'htmlOptions'=>array('data-url'=>Yii::app()->createUrl('/distEducation/saveLink'))
    )
); ?>

    <div class="modal-header">
        <a class="close" data-dismiss="modal">&times;</a>
        <h4></h4>
    </div>

    <div class="modal-body" style="overflow-y: unset">
        <div id="modal-content" >

        </div>
    </div>

<?php $this->endWidget();