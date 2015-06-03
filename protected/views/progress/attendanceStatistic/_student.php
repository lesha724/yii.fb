<?php
	$this->pageHeader=tt('Статистика посещаемости студента').' '.ShortCodes::getShortName($st[0]['st2'], $st[0]['st3'], $st[0]['st4']);
	$this->breadcrumbs=array(
		tt('Успеваемость'),
	);
	echo '<div style="width:100%">';
	if($statistic!=null)
	{
		$types = array(
            0 => tt('Всего'),
            1 => tt('Лк'),
            2 => tt('Пз'),
            3 => tt('Сем'),
            4 => tt('Лб'),
            5 => tt('Экз'),
            6 => tt('Зч'),
            7 => tt('Кр'),
            8 => tt('КП'),
            13 => tt('Доп'),
            14 => tt('Инд'),
            16 => tt('КнЧ'),
            17 => tt('Конс'),
            18 => tt('Пер'),
        );
			$table='<table class="table table-striped table-hover">
				<thread>
					<tr>
						<th>№</th>
						<th>'.tt('Дата').'</th>
						<th>'.tt('Пара').' №</th>
						<th>'.tt('Дисциплина').'</th>
						<th>'.tt('Тип').'</th>
						<th>'.tt('Преподаватель').'</th>
					</tr>
				</thread>
				<tbody>';
		$i=1;
		foreach($statistic as $key)
		{
			if($key['steg6']==2){
				$table.= '<tr class="success">';
			}
			else
			{
				$table.= '<tr>';
			}
			$table.= '<th>'.$i.'</th>
						<th>'.date('Y-m-d',strtotime($key['steg3'])).'</th>
						<th>'.$key['steg4'].'</th>
						<th>'.$key['d2'].'</th>
						<th>'.$types[$key['us4']].'</th>
						<th>'.ShortCodes::getShortName($key['p3'], $key['p4'], $key['p5']).'</th>
					</tr>';
			$i++;
		}
		$table.='</tbody>
		</table>';
		echo $table;
	}else
	{
		echo '<span class="label label-success" style="font-size:16px">'.tt('Зарегистрированных пропусков нет').'</span>';
	}
	echo '</div>';
?>