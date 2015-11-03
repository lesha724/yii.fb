<?php
    $pageSize=Yii::app()->user->getState('pageSize',10);
    if($pageSize==0)
        $pageSize=10;
    $this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'retake',
    'dataProvider' => $model->searchRetake(),
    'filter' => $model,
    'type' => 'striped bordered',
    'afterAjaxUpdate' => 'function(id) { $(\'[data-toggle="tooltip"]\').tooltip();}',
    'ajaxUrl' => Yii::app()->createAbsoluteUrl('/journal/searchRetake',array('uo1'=>$model->uo1,'us1'=>$us1)),
    'columns' => array(
        'st2'=>array(
            'header'=>tt('Студент'),
            'name'=>'st2',
            'value'=>'"<label data-toggle=\'tooltip\' data-placement=\'right\' data-original-title=\'".$data->st2." ".$data->st3." ".$data->st4."\'>".SH::getShortName($data->st2,$data->st3,$data->st4)."</label>"',
            'type'=>'raw',
            'htmlOptions'=>array('class'=>'student'),
        ),
        'group_st'=>array(
            'name'=>'group_st',
            'htmlOptions'=>array('class'=>'group_st'),
        ),
        'r2'=>array(
            'name'=>'r2',
            'value'=>'date_format(date_create_from_format("Y-m-d H:i:s", $data->r2), "d.m.Y")',
            'htmlOptions'=>array('class'=>'date'),
        ),
        'nom',
        'tema'=>array(
            'name'=>'tema',
            'htmlOptions'=>array('class'=>'tema'),
        ),
        'elgzst3'=>array(
            'name'=>'elgzst3',
            'value'=>'$data->getElgzst3()',
            'filter'=>Elgzst::model()->getElgzst3s(),
            'htmlOptions'=>array('class'=>'type'),
        ),
        'elgp3',
        'elgp2'=>array(
            'name'=>'elgp2',
            'value'=>'$data->getType()',
            'filter'=>array_merge(array(0=>tt('-(інше)')),Elgzst::model()->getTypes()),
        ),
        /*'count_elgotr'=>array(
            'name'=>'count_elgotr',
            'filter'=>''
        ),*/

        'status'=>array(
            'name'=>'status',
            'value'=>'$data->getStatus()',
            'filter'=>Elgzst::model()->getStatusArray()
        ),
        array(
                'class'=>'bootstrap.widgets.TbButtonColumn',
                'template'=>'{update} {view}',
                'header'=>CHtml::dropDownList(
                    'pageSize',
                    $pageSize,
                    array(5=>5,10=>10,20=>20,50=>50,100=>100),
                    array('class'=>'change-pageSize')
                ),
                'buttons'=>array
                (
                    'update' => array(
                        'label'=>tt('Добавить отработку'),
                        'icon'=>'icon-plus bigger-120',
                        'url'=>'array("addRetake","elgzst0"=>$data->elgzst0)',
                        'options' => array('class' => 'btn btn-mini btn-warning btn-add-retake'),
                        'visible'=>'$data->checkMinRetakeForGrid()'
                    ),
                    'view' => array(
                        'label'=>tt('Просмотр отработок'),
                        'icon'=>'icon-eye-open bigger-120',
                        'url'=>'array("showRetake","elgzst0"=>$data->elgzst0)',
                        'options' => array('class' => 'btn btn-mini btn-success btn-view-retake'),
                        //'visible'=>'$data->count_elgotr!=0'
                        'visible'=>'$data->elgzst5!=0'
                    ),
                ),
            ),
    ),
));
    Yii::app()->clientScript->registerScript('initPageSize',"
	    $.fn.yiiGridView.update('retake',{ data:{ pageSize: $(this).val() }})
            
            $(document).on('change','.change-pageSize', function() {
                $.fn.yiiGridView.update('retake',{ data:{ pageSize: $(this).val() }})
	    });",CClientScript::POS_READY);
    
    
    $this->beginWidget(
    'bootstrap.widgets.TbModal',
    array(
        'id' => 'myModal',
        'htmlOptions'=>array('data-url'=>Yii::app()->createUrl('/journal/saveRetake'))
    )
); ?>
 
    <div class="modal-header">
        <a class="close" data-dismiss="modal">&times;</a>
        <h4></h4>
    </div>
 
    <div class="modal-body">
        <div id="modal-content">
            
        </div>
    </div>
 
    <div class="modal-footer">
        <?php $this->widget(
            'bootstrap.widgets.TbButton',
            array(
                'label' => tt('Сохранить'),
                'type'=>'info',
                'url' => '#',
                'htmlOptions' => array('id' => 'save-stego'),
            )
        ); ?>
        <?php $this->widget(
            'bootstrap.widgets.TbButton',
            array(
                'label' => tt('Отмена'),
                'url' => '#',
                'htmlOptions' => array('data-dismiss' => 'modal'),
            )
        ); ?>
    </div>
 
<?php $this->endWidget();