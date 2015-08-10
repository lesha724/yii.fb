<?php
/**
 * @var WorkPlanController $this
 * @var FilterForm $model
 */
	
        $teachers = P::model()->getTeachersForListChair($model->chair);
	Yii::app()->clientScript->registerScript('list-chair', "
		initDataTable('list-chair');
	");
?>
<table id="list-chair" class="table table-striped table-hover">
<thead>
	<tr>
		<th style="width:40px">№</th>
		<th><?=tt('Ф.И.О.')?></th>
                <th><?=tt('Должность')?></th>
	</tr>
</thead>
<tbody>
        <?php 
        $i=1;
        foreach($teachers as $teacher)
	{
            echo '<tr>';
            echo '<td>'.$i.'</td>';
            echo '<td>'.$teacher['p3'].' '.$teacher['p4'].' '.$teacher['p5'].'</td>';
            echo '<td>'.$teacher['dol2'].'</td>';
            echo '</tr>';
            $i++;
        }
        ?>
</tbody>
</table>
