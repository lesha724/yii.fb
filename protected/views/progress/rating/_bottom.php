<?php
/**
 * @var $model RatingForm
 */

$options = array('class'=>'chosen-select', 'autocomplete' => 'off', 'empty' => '&nbsp;');

$data = $model->getSemestersForFilter();

$html  = '<div class="row-fluid" style="margin-bottom:2%">';
$html .= '<div class="span3 ace-select">';
$html .= CHtml::activeLabel($model, 'semStart');
$html .= CHtml::activeDropDownList($model, 'semStart', $data,$options);
$html .= '</div>';
$html .= '<div class="span3 ace-select">';
$html .= CHtml::activeLabel($model, 'semEnd');
$html .= CHtml::activeDropDownList($model, 'semEnd', $data,$options);
$html .= '</div>';
$html .= '<div class="span3 ace-select">';
$html .= CHtml::activeLabel($model, 'stType');
$html .= CHtml::activeDropDownList($model, 'stType',RatingForm::getStudentsTypes(),array('class'=>'chosen-select', 'autocomplete' => 'off'));
$html .= '</div>';
$html .= '<div class="span3">';
$html .= CHtml::activeCheckBox($model, 'ratingType',array('style'=>'float:left'));
$html .= CHtml::activeLabel($model, 'ratingType');
$html .= '</div>';
$html .= '</div>';


echo $html;

/*if (!empty($model->semStart)&&!empty($model->semEnd))
{

	$this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'link',
			'type'=>'primary',
			'icon'=>'print',
			'label'=>tt('Печать'),
			'htmlOptions'=>array(
					'class'=>'btn-mini',
					'id'=>'rating-print',
			)
	));


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

	$ps81 = PortalSettings::model()->findByPk(81)->ps2;
	$tmp = ($ps81==0)?'credniy_bal_5':'credniy_bal_100';

	$rating = Gr::model()->getRating($sg1, $group,$model->sel_1,$model->sel_2,$model->st_rating,$tmp);
	if(!empty($rating))
	{
		?>
	<table id="rating" class="table table-striped table-hover table-condensed">
	<thead>
		<tr>
			<th style="width:40px">№</th>
			<th><?=tt('Ф.И.О.')?></th>
			<th><?=$model->getAttributeLabel('group')?></th>
			<th><?=$model->getAttributeLabel('course')?></th>
			<th><?=($ps81==0)?tt('5'):tt('Многобальная')?></th>
			<th><?=tt('Не сдано')?></th>
		</tr>
	</thead>
	<tbody>
	<?php
		$i=0;
		$val='0';
		$val100='0';

		foreach($rating as $key)
		{
			$_bal = round($key[$tmp], 2);
			if($_bal!=$val)
			{
				$val=$_bal;
				$i++;
			}

			echo '<tr>'.
					'<td>'.$i.'</td>'.
					'<td>'.ShortCodes::getShortName($key['fio'], $key['name'], $key['otch']).'</td>'.
					'<td>'.$key['group_name'].'</td>'.
					'<td>'.$key['kyrs'].'</td>'.
					'<td>'.$_bal.'</td>'.
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
				<?=tt('Нет данных')?>
			</div>
		<?php
	}
}
?>*/
