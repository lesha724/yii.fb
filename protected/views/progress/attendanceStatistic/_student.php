<?php
	$this->pageHeader=tt('Статистика посещаемости студента').' '.ShortCodes::getShortName($st[0]['st2'], $st[0]['st3'], $st[0]['st4']);
	$this->breadcrumbs=array(
		tt('Успеваемость'),
	);
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
			$table='<table id="student-statistic" class="table table-striped table-hover">
				<thread>
					<tr>
						<th>№</th>
                                                <th>'.tt('Тип').'</th>
						<th>'.tt('Дата').'</th>
						<th>'.tt('Дисциплина').'</th>
						
					</tr>
				</thread>
				<tbody>';
		$i=1;
		foreach($statistic as $key)
		{
			if($key['stegn4']==2){
				$table.= '<tr class="success">';
			}
			else
			{
				$table.= '<tr>';
			}
                                 $table.= '<td>'.$i.'</td>
                                <td>'.date('Y-m-d',strtotime($key['stegn9'])).'</td>
                                <td>'.$types[$key['us4']].'</td>
                                <td>'.$key['d2'].'</td>
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
        
        
?>