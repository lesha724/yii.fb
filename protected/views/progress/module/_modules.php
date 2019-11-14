<?php
/**
 * @var ProgressController $this
 * @var ModuleForm $model
 * @var $modules Mod[]
 */

$this->widget('bootstrap.widgets.TbGridView', array(
    'dataProvider' => new CArrayDataProvider($modules),
    'type' => 'striped bordered',
    'columns' => array(
        'mod5',
        'mod6',
        'mod7',
        'mod8'
    )
));