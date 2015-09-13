<?php
/**
 * @var WorkPlanController $this
 * @var FilterForm $model
 */
	$students=St::model()->getListGroup($model->group);
	Yii::app()->clientScript->registerScript('list-group', "
		initDataTable('list-group');
	");
    $ps34=PortalSettings::model()->findByPk(34)->ps2;
    $visible_passport=false;
    if($ps35==1&&Yii::app()->user->isAdmin&&$dbh!=null)
        $visible_passport=true;
?>
<table id="list-group" class="table table-striped table-hover">
<thead>
	<tr>
		<th style="width:40px">№</th>
		<th style="width:200px">№ <?=tt('зач. книжки')?></th>
        <?php if($ps34==1):?>
		<th style="width:90px"><?=tt('Вид фин.')?></th>
        <?php endif;?>
		<th><?=tt('Ф.И.О.')?></th>
        <?php if($visible_passport):?>
            <th><?=tt('Паспорт.')?></th>
            <th><?=tt('Загран паспорт.')?></th>
        <?php endif;?>
	</tr>
</thead>
<tbody>
<?php
    $pattern ='<td><span class="label label-%s">%s</span></td>';
	$type=array(
		0=>tt('бюджет'),
		1=>tt('контракт')
	);
	$i=1;
	foreach($students as $student)
	{
        if($ps34==1){
            if($student['sk3']==0){
                echo '<tr class="success">';
            }else
            {
                echo '<tr class="warning">';
            }
        }else
            echo '<tr class="info">';
		echo '<td>'.$i.'</td>';
		echo '<td>'.$student['st5'].'</td>';
        if($ps34==1)
		    echo '<td>'.$type[$student['sk3']].'</td>';
		echo '<td>'.$student['st2'].' '.$student['st3'].' '.$student['st4'].'</td>';
        if($visible_passport){
            if(St::model()->checkPassport($dbh,$student['st1'],1)){
                echo sprintf($pattern,'success','+');
            }else
            {
                echo sprintf($pattern,'important','-');
            }

            if(St::model()->checkPassport($dbh,$student['st1'],2)){
                echo sprintf($pattern,'success','+');
            }else
            {
                echo sprintf($pattern,'important','-');
            }
        }
		echo '</tr>';
		$i++;
	}
?>
</tbody>
</table>
