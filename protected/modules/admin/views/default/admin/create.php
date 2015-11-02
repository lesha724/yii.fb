<?php
$this->pageTitle=tt('Создать');
$this->pageHeader=tt('Создать');

$this->breadcrumbs=array(
    tt('Администраторы').':'.tt('Создать')

);

$this->menu=array(
    array('label'=>tt('Cписок'),'icon'=>'list',  'url'=>array('admin')),
);
if(!empty($this->menu))
{
    echo $this->renderPartial('/default/_menu');
}
?>
    <div class="showback span-12">
<?php echo $this->renderPartial('admin/_form', array('model'=>$model)); ?>
        </div>