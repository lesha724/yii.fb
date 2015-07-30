<?php
$this->pageHeader=tt('Пункты меню (доп.): Редактировать');
$this->breadcrumbs=array(
	tt('Пункты меню (доп.)')=>array('index'),
	tt('Редактировать'),
);

$this->menu=array(
    array('label'=>tt('Список'),'icon'=>'list',  'url'=>array('index')),
    array('label'=>tt('Создать'),'icon'=>'plus', 'url'=>array('create')),
);
if(!empty($this->menu))
{
    echo $this->renderPartial('_menu');
}
?>

<h1>Update Pm <?php echo $model->pm1; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>