<?php
$options = array('class'=>'chosen-select', 'autocomplete' => 'off', 'empty' => '&nbsp;');
$inost=array(
	0=>tt('Все'),
	1=>tt('Не иностранцы'),
	2=>tt('Иностранцы'),
);
$data = CHtml::listData(Sem::model()->getSemestersForRating($model->group, $type), 'sem7', 'sem7', 'name');

$html  = '<div class="row-fluid" style="margin-bottom:2%">';
$html .= '<div class="span3 ace-select">';
$html .= CHtml::label(tt('Семестр'), 'FilterForm_semester');
$html .= CHtml::dropDownList('FilterForm[semester]', $model->semester,array('-1'=>tt('За весь период'))+$data, $options);
$html .= '</div>';
$html .= '<div class="span3 ace-select">';
$html .= CHtml::label(tt('Студенты'), 'FilterForm_st_rating');
$html .= CHtml::dropDownList('FilterForm[st_rating]', $model->st_rating,$inost,array('class'=>'chosen-select', 'autocomplete' => 'off'));
$html .= '</div>';
$html .= '<div class="span3">';
$html .=CHtml::activeCheckBox($model, 'type_rating',array('style'=>'float:left')).CHtml::label($model->getAttributeLabel('type_rating'),'FilterForm_type_rating',array('style'=>'float:left'));
$html .= '</div>';
$html .= '</div>';


echo $html;

if (!empty($model->semester))
{
	$sem = $model->semester;
	if($sem==-1)
		$sem=0;
	$group=$model->group;
	$sg1=0;
	if($model->type_rating==1){
		
		$criteria = new CDbCriteria;
		$criteria->select = 'gr2';
		$criteria->condition = 'gr1 = '.$model->group;
		$data = Gr::model()->find($criteria);
		if(!empty($data))
		{
			$group=0;
			$sg1=$data->gr2;
		}
	}
	$rating = Gr::model()->getRating($sg1, $group,$sem,$model->st_rating);
	if(!empty($rating))
	{
		/*Yii::app()->clientScript->registerScript('list-group', "
			initDataTable('rating');
		");*/
		?>
	<table id="rating" class="table table-striped table-hover table-condensed">
	<thead>
		<tr>
			<th style="width:40px">№</th>
			<th><?=tt('Ф.И.О.')?></th>
			<th><?=$model->getAttributeLabel('group')?></th>
			<th><?=$model->getAttributeLabel('course')?></th>
			<th><?=tt('5')?></th>
			<?php /*<th><?=tt('100')?></th>*/ ?>
			<th><?=tt('Не сдано')?></th>
		</tr>
	</thead>
	<tbody>
	<?php
		$i=0;
		$val5='0';
		$val100='0';
		foreach($rating as $key)
		{
			//if($key['credniy_bal_5']!=$val5 || $key['credniy_bal_100']!=$val100)
			$_bal = round($key['credniy_bal_5'], 1);
			if($_bal!=$val5)
			{
				$val5=$_bal;
				$val100=$key['credniy_bal_100'];
				$i++;
			}
			echo '<tr>'.
					'<td>'.$i.'</td>'.
					'<td>'.ShortCodes::getShortName($key['fio'], $key['name'], $key['otch']).'</td>'.
					'<td>'.$key['group_name'].'</td>'.
					'<td>'.$key['kyrs'].'</td>'.
					'<td>'.$_bal.'</td>'.
					//'<td>'.round($key['credniy_bal_100'], 1).'</td>'.
					'<td>'.$key['ne_sdano'].'</td>'.
				'</tr>';
		}
	?>
	</tbody>
	</table>
<?php
	}else
	{
		?>
			<div class="alert alert-danger" role="alert">
				<?='Empty array'?>
			</div>
		<?php
	}
}
?>
