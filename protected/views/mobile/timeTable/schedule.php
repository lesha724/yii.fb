<?php
/**
 * Created by PhpStorm.
 * User: Neff
 * Date: 09.02.2016
 * Time: 11:13
 */


    ?>
    <div class="panel-actions row">
        <div class="form-actions col-xs-12">
            <button id="lesson-left" class="btn col-xs-2" type="button"><i class="arrow glyphicon arrow-left"></i></button>
            <div class="form-group col-xs-8">
                <div class='input-group datepicker'  id="lesson-datepicker">
                    <?= CHtml::textField('TimeTableForm[dateLesson]',$model->dateLesson, array('class'=>'form-control'));?>
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar">
                        </span>
                    </span>
                </div>
            </div>
            <button id="lesson-right" class="btn col-xs-2" type="button"><i class="arrow glyphicon arrow-right"></i></button>
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
            calendarWeeks: true,
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
                <tr>
                    %s
                </tr>
            </thead>
            <tbody>
                %s
            </tbody>
        </table>
HTML;

    $tr = $th = '';
    foreach($timeTable as $event){

        $r2=$event['r2'];
        $r3=$event['r3'];
        $full_name=str_replace( "'",'"', $event['d2']);
        $short_name = $event['d3'];
        if(isset($event['fio']))
            $fio=$event['fio'];
        else
            $fio='';
        $groups=$event['gr3'];
        $rz3 = $event['rz3'];
        $rz2 = $event['rz2'];
        $a2  = $event['a2'];
        $time="";
        $pos=stripos($event['d3'],"(!)");
        if($pos!==false)
            $time='<br>'.$event['rz2'].'-'.$event['rz3'].'<br>';

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
            }
        }

        //$tr.=;
    }

    echo sprintf($table,$th,$tr);