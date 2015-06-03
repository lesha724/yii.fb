<?php
/* @var $this DefaultController
 * @var $model FilterForm
 */


if (!empty($model->statement))
{
	$stats=Gr::model()->getStatement($model->group,$model->statement);
	if($stats!=null)
	{
		$url = Yii::app()->createUrl('progress/insertVmp');
		?>
		<table data-url="<?=$url?>" data-vmpv1="<?=$model->statement?>" class="table table-striped table-hover table-bordered table-resposive">
			<thead>
				<tr>
					<th style="width:5%">№</th>
					<th style="width:30%"><?=tt('Ф.И.О.')?></th>
					<th style="width:20%">№ <?=tt('зач. книжки')?></th>
					<th>5</th>
				</tr>
			</thead>
			<tbody>
		<?php
		$num=0;
		foreach($stats as $stat) {
				$num++;
				$name = ShortCodes::getShortName($stat['st2'], $stat['st3'], $stat['st4']);
				$tr='<tr data-st1="'.$stat['st1'].'">';	
					$tr.='<td>'.$num.'</td>';
					$tr.='<td>'.$name.'</td>';
					$tr.='<td>'.$stat['st5'].'</td>';
					$tr.='<td><input maxlength="1" style="height:10px;margin:0;width:30px" type="text" value="'.$stat['vmp4'].'" name="stus3"></td>';
				$tr.='</tr>';
				echo $tr;
		}
		?>
			</tbody>
		</table>
		<?php
	}
}