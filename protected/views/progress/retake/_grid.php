<?php
    $pageSize=Yii::app()->user->getState('pageSize',10);
    $this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'retake',
    'dataProvider' => $model->searchRetake(),
    'filter' => $model,
    'type' => 'striped bordered',
    'afterAjaxUpdate' => 'function(id) { $(\'[data-toggle="tooltip"]\').tooltip();}',
    'ajaxUrl' => Yii::app()->createAbsoluteUrl('/progress/searchRetake',array('us1'=>$model->stegn2)),
    'columns' => array(
        'st2'=>array(
            'header'=>tt('Студент'),
            'name'=>'st2',
            'value'=>'"<label data-toggle=\'tooltip\' data-placement=\'right\' data-original-title=\'".$data->st2." ".$data->st3." ".$data->st4."\'>".SH::getShortName($data->st2,$data->st3,$data->st4)."</label>"',
            'type'=>'raw',
            'htmlOptions'=>array('class'=>'student'),
        ),
        'tema'=>array(
            'name'=>'tema',
            'htmlOptions'=>array('class'=>'tema'),
        ),
        'stegn3'=>array(
            'name'=>'stegn3',
            'htmlOptions'=>array('class'=>'number'),
        ),
        'stegn4'=>array(
            'name'=>'stegn4',
            'value'=>'$data->getStegn4()',
            'filter'=>Stegn::model()->getStegn4s(),
            'htmlOptions'=>array('class'=>'type'),
        ),
        'stegn9'=>array(
            'name'=>'stegn9',
            'value'=>'date_format(date_create_from_format("Y-m-d H:i:s", $data->stegn9), "d.m.Y")',
            'htmlOptions'=>array('class'=>'date'),
        ),
        'stegn11',
        'stegn10'=>array(
            'name'=>'stegn10',
            'value'=>'$data->getType()',
            'filter'=>array_merge(array(0=>tt('-(інше)')),Stegn::model()->getTypes()),
        ),
        'count_stego'=>array(
            'name'=>'count_stego',
            'filter'=>''
        ),
        'status'=>array(
            'name'=>'status',
            'value'=>'$data->getStatus()',
            'filter'=>Stegn::model()->getStatusArray()
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
                        'url'=>'array("addRetake","stegn0"=>$data->stegn0,"disp"=>$data->stegn2)',
                        'options' => array('class' => 'btn btn-mini btn-warning btn-add-retake'),
                        'visible'=>'$data->checkMinRetakeForGrid()'
                    ),
                    'view' => array(
                        'label'=>tt('Просмотр отработок'),
                        'icon'=>'icon-eye-open bigger-120',
                        'url'=>'array("showRetake","stegn0"=>$data->stegn0,"disp"=>$data->stegn2)',
                        'options' => array('class' => 'btn btn-mini btn-success btn-view-retake'),
                        'visible'=>'$data->count_stego!=0'
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
        'htmlOptions'=>array('data-url'=>Yii::app()->createUrl('/progress/saveRetake'))
    )
); ?>
 
    <div class="modal-header">
        <a class="close" data-dismiss="modal">&times;</a>
        <h4><?=tt('Отработка')?></h4>
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