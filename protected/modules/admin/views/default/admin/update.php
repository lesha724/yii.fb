<?php
$this->pageTitle=tt('Редактировать');
$this->pageHeader=tt('Редактировать');

$this->breadcrumbs=array(
    tt('Администраторы').':'.tt('Редактировать')

);


$this->menu=array(
    array('label'=>tt('Cписок'),'icon'=>'list',  'url'=>array('admin')),
    array('label'=>tt('Создать'),'icon'=>'plus', 'url'=>array('adminCreate')),
);
if(!empty($this->menu))
{
    echo $this->renderPartial('/default/_menu');
}
?>
    <div class="showback span-12">
<?php echo $this->renderPartial('admin/_form', array('model'=>$model)); ?>
        </div>