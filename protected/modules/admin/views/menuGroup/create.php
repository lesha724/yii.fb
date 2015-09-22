<?php
$this->pageHeader=tt('Группы пунктов меню (доп.): Создать');
$this->breadcrumbs=array(
    tt('Группы пунктов меню (доп.)')=>array('index'),
    tt('Создать'),
);

$this->menu=array(
    array('label'=>tt('Список'),'icon'=>'list','url'=>array('index')),
);
if(!empty($this->menu))
{
    echo $this->renderPartial('/default/_menu');
}
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>