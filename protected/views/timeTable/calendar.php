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
	$groups='';
        $text='';
        $fullText='';
        if(!empty($timeTable))
        {
            //$r1=$timeTable[0]['R1'];
            $r2=$timeTable[0]['r2'];
            $r3=$timeTable[0]['r3'];
            foreach($timeTable as $event)
            {
                    if(isset($event['fio']))
                            $fio=$event['fio'];
                    else
                            $fio='';
                    if(($r2!=$event['r2'])||($r3!=$event['r3']))
                    {		
                            if($arr=='[')
                                    $arr.=$fullText;
                            else
                                    $arr.=','.$fullText;
                            $groups='';
                            $events.=$text;
                            //$r1=$event['r1'];
                            $r2=$event['r2'];
                            $r3=$event['r3'];
                            $i++;
                    }
                    if($groups=='')
                            $groups=$event['gr3'];
                    else
                            $groups.=','.$event['gr3'];
                    $text='{';
                    $text.="id:'".$i."',";
                    $color = SH::getLessonColor($event['tip']);
                    $class = SH::getClassColor($event['tip']);
                    $text.="title:' ".$event['d3']."[".$event['tip']."]\u000A ".$event['a2']." ".$fio."\u000A".$groups."',";
                    $text.="className:'event-num{$i} events event{$class}',";
                    $text.="start:'".date("Y-m-d",strtotime($event['r2']))." ".$event['rz2']."',";
                    $text.="end:'".date("Y-m-d",strtotime($event['r2']))." ".$event['rz3']."',";
                    $text.='},';
                    $fullText='["'.$event['d2'].'","'.$event['tip'].'","'.$fio.'","'.$event['a2'].'","'.date("Y-m-d",strtotime($event['r2'])).'","'.$event['rz2'].'","'.$event['rz3'].'","'.$groups.'"]';
            }
        }
	$events.=$text;
	$arr.=$fullText;
	$arr.=']';
?>
	<button id="print-table" class="btn btn-info btn-small">
        <i class="icon-print bigger-110"></i>
    </button>
	<div id="calendar">
		<div id="info-event" class="popover bottom">
			<div class="arrow"></div>
			<button id="close-info-event" class="close" style="margin:5px;">&times;</button>
			<h4 class="popover-title" id="info-event-header"></h4>
			<div class="popover-content">
				<h5 id="info-event-body-header"></h5>
				<p id="info-event-body"></p>
				<p id="cor"></p>
			</div>
		</div>
	</div>
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
				
				$('#info-event-header').text(arr[calEvent.id][4]+\" \"+arr[calEvent.id][5]+\"-\"+arr[calEvent.id][6]);
				$('#info-event-body-header').text(arr[calEvent.id][0]+\"[\"+arr[calEvent.id][1]+\"]\");
				$('#info-event-body').html(arr[calEvent.id][2]+\" </br>\"+arr[calEvent.id][3]);
				showEnevtInfo(calEvent.id);
				/*alert('#cell'+calEvent.id);*/
			},
		});
		
	});
	
	function showEnevtInfo(id){
		event=$('.event-num'+id);
		sum=getOffset(event[0]);
		info=$('#info-event');
		info.css('top',sum.top-60);
		info.css('left',sum.left);		
		info.show();
		visible=true;
	}
	
	function getOffset(elem) {
		if (elem.getBoundingClientRect) {
			return getOffsetRect(elem)
		} else {
			return getOffsetSum(elem)
		}
	}

	function getOffsetSum(elem) {
		var top=0, left=0
		while(elem) {
			top = top + parseInt(elem.offsetTop)
			left = left + parseInt(elem.offsetLeft)
			elem = elem.offsetParent
		}
		return {top: top, left: left}
	}

	function getOffsetRect(elem) {
		// (1)
		var box = elem.getBoundingClientRect()

		// (2)
		var body = document.body
		var docElem = document.documentElement

		// (3)
		var scrollTop = window.pageYOffset || docElem.scrollTop || body.scrollTop
		var scrollLeft = window.pageXOffset || docElem.scrollLeft || body.scrollLeft

		// (4)
		var clientTop = docElem.clientTop || body.clientTop || 0
		var clientLeft = docElem.clientLeft || body.clientLeft || 0

		// (5)
		var top  = box.top +  scrollTop - clientTop
		var left = box.left + scrollLeft - clientLeft

		return { top: Math.round(top), left: Math.round(left) }
	}

	$('#print-table').click(
		function(){
			$('#sidebar').addClass('menu-min');
			window.print();
		}
	);
	
	$('#close-info-event').click(
		function(){
			$('#info-event').hide();
		}
	);
");

?>
