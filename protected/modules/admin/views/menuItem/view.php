<?php
$this->pageHeader=tt('Пункты меню (доп.): Просмотр');
$this->breadcrumbs=array(
    tt('Пункты меню (доп.)')=>array('index'),
    tt('Просмотр'),
);

$this->menu=array(
    array('label'=>tt('Список'),'icon'=>'list',  'url'=>array('index')),
    array('label'=>tt('Создать'),'icon'=>'plus', 'url'=>array('create')),
    array('label'=>tt('Редактировать'),'icon'=>'pencil', 'url'=>array('update', 'id'=>$model->pm1)),
    array('label'=>tt('Удалить'),'icon'=>'remove','url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->pm1),'confirm'=>tt('Вы уверены?'))),
);

if(!empty($this->menu))
{
    echo $this->renderPartial('/default/_menu');
}
?>
<?php
$this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
        'pm2',
        'pm3',
        'pm4',
        'pm5',
        'pm6',
        'pm7'=>array(
            'name'=>'pm7',
            'value'=>$model->getPm7(),
        ),
        'pm8'=>array(
            'name'=>'pm8',
            'value'=>$model->getPm8()
        ),
        'pm9',
        'pm10'=>array(
            'name'=>'pm10',
            'value'=>$model->getPm10()
        ),
        'pm11'=>array(
            'name'=>'pm11',
            'value'=>$model->getPm11()
        ),
        array(
            'name'=>  Pmc::model()->getAttributeLabel('pmc1'),
            'value'=>$model->getParentTitle(),
        ),
	),
));
?>
