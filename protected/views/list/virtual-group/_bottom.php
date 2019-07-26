<?php
/**
 * Created by PhpStorm.
 * User: Neff
 * Date: 02.12.2016
 * Time: 22:30
 */
/**
 * @var ListController $this
 * @var FilterForm $model
 */
	$students=St::model()->getListVirtualGroup($model->group);
	Yii::app()->clientScript->registerScript('list-virtual-group', "
		initDataTable('list-virtual-group');
	");

//$ps34=PortalSettings::model()->findByPk(34)->ps2;

$this->widget('bootstrap.widgets.TbButton', array(
    'buttonType'=>'button',
    'type'=>'primary',

    'icon'=>'print',
    'label'=>tt('Печать'),
    'htmlOptions'=>array(
        'class'=>'btn-small',
        'data-url'=>Yii::app()->createUrl('/list/virtualGroupExcel'),
        'id'=>'btn-print-excel',
    )
));
?>

<table id="list-virtual-group" class="table table-striped table-hover">
    <thead>
    <tr>
        <th style="width:40px">№</th>
        <th><?=tt('ФИО студента')?></th>
        <th><?=tt('Академ. группа')?></th>
        <th style="width:200px">№ <?=tt('зач. книжки')?></th>
    </tr>
    </thead>
    <tbody>
    <?php
    $i=1;
    foreach($students as $student)
    {
        echo '<tr class="info">';
        echo '<td>'.$i.'</td>';
        $name = $student['pe2'].' '.$student['pe3'].' '.$student['pe4'];
        echo '<td>'.$name.'</td>';
        echo '<td>'.Gr::model()->getGroupName($model->course, $student).'</td>';
        echo '<td>'.$student['st5'].'</td>';
        echo '</tr>';
        $i++;
    }
    ?>
    </tbody>
</table>
