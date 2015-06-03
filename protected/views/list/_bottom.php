<?php
/**
 * @var WorkPlanController $this
 * @var FilterForm $model
 */
	$students=St::model()->getListGroup($model->group);
	Yii::app()->clientScript->registerScript('list-group', "
		initDataTable('list-group');
	");
?>
<table id="list-group" class="table table-striped table-hover">
<thead>
	<tr>
		<th style="width:40px">№</th>
		<th style="width:200px">№ <?=tt('зач. книжки')?></th>
		<th style="width:90px"><?=tt('Вид фин.')?></th>
		<th><?=tt('Ф.И.О.')?></th>
	</tr>
</thead>
<tbody>
<?php
	$type=array(
		0=>tt('бюджет'),
		1=>tt('контракт')
	);
	$i=1;
	foreach($students as $student)
	{
		if($student['sk3']==0){
			echo '<tr class="success">';
		}else
		{
			echo '<tr class="warning">';
		}
		echo '<td>'.$i.'</td>';
		echo '<td>'.$student['st5'].'</td>';
		echo '<td>'.$type[$student['sk3']].'</td>';
		echo '<td>'.$student['st2'].' '.$student['st3'].' '.$student['st4'].'</td>';
		echo '</tr>';
		$i++;
	}
?>
</tbody>
</table>
