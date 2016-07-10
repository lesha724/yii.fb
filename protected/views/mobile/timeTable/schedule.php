<?php
/**
 * Created by PhpStorm.
 * User: Neff
 * Date: 09.02.2016
 * Time: 11:13
 */
    function getLessonNumberColumn($nomZan,$rz){
        $start=isset($rz[$nomZan]) ? $rz[$nomZan]['rz2']: null;
        $finish=isset($rz[$nomZan]) ? $rz[$nomZan]['rz3']: null;
        $tmp='<span class="lesson label label-primary">'.$nomZan.' '.tt('пара').'</span><span class="start label label-info">'.$start.'</span><span class="finish label label-info">'.$finish.'</span>';
        return $tmp;
    }

    ?>
    <div class="panel-actions row">
        <div class="form-actions col-xs-12">
            <button id="lesson-left" class="btn col-xs-2" type="button"><i class="arrow glyphicon glyphicon-triangle-left"></i></i></button>
            <div class="form-group col-xs-8">
                <div class='input-group datepicker'  id="lesson-datepicker">
                    <?= CHtml::textField('TimeTableForm[dateLesson]',$model->dateLesson, array('class'=>'form-control'));?>
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar">
                        </span>
                    </span>
                </div>
            </div>
            <button id="lesson-right" class="btn col-xs-2" type="button"><i class="arrow glyphicon glyphicon-triangle-right"></i></button>
        </div>
    </div>
    <div class="col-xs-12 table-time">
    </div>
    <?php
    $lang = Yii::app()->language;
    $js =<<<JS
         $('#lesson-datepicker .form-control').datepicker({
            todayBtn: "linked",
            format: "dd.mm.yyyy",
            language: '{$lang}',
            daysOfWeekHighlighted: "0,6",
            calendarWeeks: false,
            autoclose: true,
            todayHighlight: true,
            toggleActive: true
        });
JS;
    Yii::app()->clientScript->registerScript('lesson-datepicker',$js,CClientScript::POS_END);

    if(empty($timeTable)){
        echo '<div class="alert alert-danger" role="alert"><h3>'.Yii::t('main','Занятия не найдены!').'</h3></div>';
    }

    $table = <<<HTML
        <table class="table table-bordered table-condensed timeTable-table">
            <thead>
                %s
            </thead>
            <tbody>
                %s
            </tbody>
        </table>
HTML;
    /*формирование таблицы*/
    $tr = $th = '';
    $nom =date('N',strtotime($model->dateLesson));
    $th.='<tr><th colspan="2" class="text-center">'.SH::russianDayName($nom).', '.$model->dateLesson.'</th></tr>';
    /*$tr.='<tr>';
    $tr.='<th>№ '.tt('пары').'</th>';
    $tr.='<th>№ '.tt('пары').'</th>';
    $tr.='</tr>';*/
    $nomZan = 0;
    foreach($timeTable as $event){

        $r3=$event['r3'];

        if($r3!=$nomZan){
            if($nomZan != 0) {
                $tr .= '</td>';
                $tr .= '</tr>';

                /*что бы если к примеру есть пары только на 1 и 4 паре что бы 2б3 пара выводилась и показывалась что пар нет*/
                $raznost = $r3-$nomZan;
                for($i =1;$i<$raznost;$i++){
                    $tr.='<tr>';
                    $tr .= '<th class="text-center lesson-number">';
                    $tr .= getLessonNumberColumn($nomZan+$i,$rz);
                    $tr .= '</th>';
                    $tr .= '<td>';
                    $tr .= '</td>';
                    $tr.='</tr>';
                }
            }
            $nomZan = $r3;
            $tr.='<tr>';

            $tr .= '<th class="text-center lesson-number">';
            //$tr .= '<div class="cell cell-vertical">'.$tmp.'</div>';
            $tr .= getLessonNumberColumn($nomZan,$rz);
            $tr .= '</th>';

            $tr .= '<td>';
        }

        $r2=$event['r2'];
        $full_name=str_replace( "'",'"', $event['d2']);
        $short_name = $event['d3'];

        if(isset($event['fio']))
            $fio=$event['fio'].'</br>';
        else
            $fio='';

        $groups=$event['gr3'];
        if($groups!='')
            $groups.='</br>';

        $rz3 = $event['rz3'];
        $rz2 = $event['rz2'];
        $a2  = $event['a2'];
        $time="";
        $pos=stripos($event['d3'],"(!)");
        if($pos!==false)
            $time='<label class="label label-warning">'.$event['rz2'].'-'.$event['rz3'].'</label></br>';

        $tem_name_full='';
        $tem_name='';
        if(isset($event['r1_']))
        {
            $tem = $model->getTem($event['r1_'],$event['r2']);
            if(!empty($tem))
            {
                $tem_name_full=$tem['name_temi'];
                $tem_name=' '.tt('т.').$tem['nom_temi'];
                if($tem['nom_zan']>0)
                    $tem_name.=' '.tt('з.').$tem['nom_zan'];

                $tem_name.='</br>';
            }
        }
        $color = SH::getLessonColor($event['tip']);
        $classElem = SH::getClassColor($event['tip']);
        $class = tt('ауд');
        $text  = tt('Добавлено');
        $added = date('d.m.Y H:i', strtotime($event['r11']));

        $lessonHtml = '<div style="background-color:'.$color.';" class="events event'.$classElem.'">';
        $lessonHtml .= <<<HTML
            {$full_name} [{$event['tip']}] </br>
            {$time}
            {$tem_name}
            {$class}. {$a2}</br>
            {$fio}{$groups}
            {$text}: {$added}
HTML;
        $lessonHtml .= '</div>';

        $tr.=$lessonHtml;

        //$tr.=;
    }


    $tr.='</tr>';

    echo sprintf($table,$th,$tr);