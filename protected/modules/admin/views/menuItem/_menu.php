<div id="icon-menu" class="span-12">
<?php $this->widget('bootstrap.widgets.TbMenu', array(
        //'type'=>'pills', // '', 'tabs', 'pills' (or 'list')
        //'stacked'=>false, // whether this is a stacked menu
        'items'=>$this->menu,
        'type'=>'pills',
        'stacked'=>false,
        'htmlOptions'=>array(
            'id'=>'group-item',
            'class'=>'operations navbar-right'
        ),
    ));
?>
</div>

