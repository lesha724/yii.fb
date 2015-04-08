<?php
	$types = array(
            0 => 'label',
            1 => 'label label-success',
            2 => 'label label-warning',
            3 => 'label label-important',
            4 => 'label label-info',
            5 => 'label label-inverse',
            6 =>'label',
            7 => 'label label-success',
            8 =>'label label-warning',
            13 =>'label label-important',
            14 => 'label label-info',
            16 => 'label label-inverse',
            17 => 'label',
            18 => 'label',
        );
	/*$css='';	
	for( $i= 0 ; $i <= 18 ; $i++ ) 
	{
		$css.='.event'.$i.'{
			background-color:'.$.';
		}';
	}*/
	$events='';
	$arr='[';
	$i=0;
	foreach($timeTable as $event)
	{
		if($arr=='[')
			$arr.='["'.$event['d2'].'","'.$event['tip'].'","'.$event['fio'].'","'.$event['a2'].'","'.date("Y-m-d",strtotime($event['r2'])).'","'.$event['rz2'].'","'.$event['rz3'].'"]';
		else
			$arr.=',["'.$event['d2'].'","'.$event['tip'].'","'.$event['fio'].'","'.$event['a2'].'","'.date("Y-m-d",strtotime($event['r2'])).'","'.$event['rz2'].'","'.$event['rz3'].'"]';
		$events.='{';
		$fullText='';
		$events.="id:'".$i."',";
		$fullText='----';
		$color = SH::getLessonColor($event['tip']);
		$class = SH::getClassColor($event['tip']);
		//$events.="title:' <div id=\"cell{$i}\" style=\"background:{$color}\" data-rel=\"tooltip\" data-placement=\"right\" data-content=\"{$fullText}\">".$event['d3']."[".$event['tip']."</br>".$event['fio']."</br>".$event['a2']."</div>',";
		$events.="title:' ".$event['d3']."[".$event['tip']."] \u000A ".$event['fio']." \u000A ".$event['a2']."',";
		$events.="className:'events event{$class}',";
		$events.="start:'".date("Y-m-d",strtotime($event['r2']))." ".$event['rz2']."',";
		$events.="end:'".date("Y-m-d",strtotime($event['r2']))." ".$event['rz3']."',";
		$events.='},';
		$i++;
	}
	$arr.=']';
?>
	<button id="print-table" class="btn btn-info btn-small">
        <i class="icon-print bigger-110"></i>
    </button>
	<div id="calendar"></div>
<?php
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/theme/ace/assets/js/moment.min.js', CClientScript::POS_HEAD);
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/theme/ace/assets/js/jquery-ui.custom.min.js', CClientScript::POS_HEAD);
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/theme/ace/assets/js/fullcalendar2.min.js', CClientScript::POS_HEAD);
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/theme/ace/assets/js/lang-all.js', CClientScript::POS_HEAD);
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/theme/ace/assets/js/jquery.leanModal.min.js', CClientScript::POS_HEAD);
Yii::app()->clientScript->registerCssFile('/theme/ace/assets/css/fullcalendar.min.css');
//Yii::app()->clientScript->registerCssFile('/theme/ace/assets/css/fullcalendar.print.css');
Yii::app()->clientScript->registerScript('calendar', "
	$(document).ready(function() {
	var arr=".$arr.";
		$('#calendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
			},
			buttonIcons: true,
			defaultDate: '".date("Y-m-d",strtotime($model->date1))."',
			lang: '".Yii::app()->language."',
			editable: false,
			eventLimit: true,
			events: [".$events."
			],
			eventClick: function(calEvent, jsEvent, view) {
				
				/*$('#myModal-header').text(arr[calEvent.id][4]+\" \"+arr[calEvent.id][5]+\"-\"+arr[calEvent.id][6]);
				$('#myModal-body-header').text(arr[calEvent.id][0]+\"[\"+arr[calEvent.id][1]+\"]\");
				$('#myModal-body').html(arr[calEvent.id][2]+\" </br>\"+arr[calEvent.id][3]);
				$('#myModal').modal({'show':true});*/
				$('#cell'+calEvent.id).tooltip('show');
				/*alert('#cell'+calEvent.id);*/
			},
			/*eventRender: function (event, element) {
				element.find('span.fc-event-title').html(element.find('span.fc-event-title').text());           
			}*/
		});
		
	});
	
	
	$('#print-table').click(
		function(){
			$('#sidebar').addClass('menu-min');
			window.print();
		}
	);
	
");
?>

