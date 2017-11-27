<?php
/* @var $this DistEducationController */
/* @var $model DistEducationFilterForm */

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
            'header'=>tt('Дисциплина'),
            'value'=>'$data["d2"]',
        ),
        'sem4'=>array(
            'header'=>tt('Курс потока'),
            'value'=>'$data["sem4"]',
        ),
        'sp2'=>array(
            'header'=>tt('Специальность'),
            'value'=>'$data["sp2"]',
        ),
        array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'template'=>'',
            'header'=>CHtml::dropDownList(
                'pageSize',
                $pageSize,
                array(5=>5,10=>10,20=>20,50=>50,100=>100),
                array('class'=>'change-pageSize')
            ),
            'buttons'=>array
            (
                /*'update' => array(
                    'label'=>tt('Добавить отработку'),
                    'icon'=>'icon-plus bigger-120',
                    'url'=>'array("addRetake","elgzst0"=>$data["elgzst0"],"sem1"=>$data["sem1"],"gr1"=>$data["gr1"],"r1"=>$data["r1"])',
                    'options' => array('class' => 'btn btn-mini btn-warning btn-add-retake'),
                    'visible'=>'Elgzst::checkMinRetakeForGridRetake($data["elgzst5"])'
                )*/
            ),
        ),
    ),
));
//print_r($model->st2);
Yii::app()->clientScript->registerScript('initPageSize',"           
        $(document).on('change','.change-pageSize', function() {
            $.fn.yiiGridView.update('disp-list',{ data:{ pageSize: $(this).val() }})
	    });",CClientScript::POS_READY);
