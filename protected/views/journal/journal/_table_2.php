<?php
function getMarsForElgz3($nom,$marks){
    if(isset($marks[$nom])) {
        $m = $marks[$nom]['elgzst5'] != 0
            ? $marks[$nom]['elgzst5']
            : $marks[$nom]['elgzst4'];
        return  $m;
    }
    return 0;
}
function table2Tr($date,$gr1,$st,$marks,$permLesson,$read_only,$type_lesson,$ps20,$ps55,$ps56,$sem7,$ps60,$min,$ps65,$show,$moduleNom,$ps88)
{
    if (($st['st71']!=$sem7&&$st['st71']!=$sem7+1) &&$ps60==1)
        return '<td colspan="2"></td>';

    if (stripos($date['r2'], '11.11.1111')!==false )
        return '<td colspan="2"></td>';

    if (strtotime($date['r2']) > strtotime('now'))
        return '<td colspan="2"></td>';
    if ($ps56 == 1 && $date['elgz4']>0)
        return '<td colspan="2"></td>';


    $r1  = $date['r1'];
    $ps2 = PortalSettings::model()->getSettingFor(27);
    $nom=$date['elgz3'];
    $elgz1=$date['elgz1'];
    $date_lesson=$date['r2'];
    $type=$date['elgz4'];

    $disabled = null;

    if(isset($permLesson[$elgz1]))
        if(strtotime($permLesson[$elgz1]) <= strtotime('yesterday'))
            $disabled = 'disabled="disabled"';
        else
            $disabled = '';

    $ps78 = PortalSettings::model()->findByPk(78)->ps2;
    if($ps78==0) {
        $date1 = new DateTime(date('Y-m-d H:i:s'));
        $date2 = new DateTime($date_lesson);
        if (!empty($ps2) && !isset($permLesson[$elgz1])) {
            $diff = $date1->diff($date2)->days;
            if ($diff > $ps2) {
                $disabled = 'disabled="disabled"';
            }
        }
    }else{

        $ps79 = PortalSettings::model()->findByPk(79)->ps2;
        $date2 = new DateTime($date_lesson/*.' '.$rz->rz9.':'.$rz->rz10*/);
        $date2->modify('+'.$date['rz9'].' hours');
        $date2->modify('+'.$date['rz10'].' minutes');

        $date2->modify('-10 minutes');

        $date3 = new DateTime($date_lesson);
        $date3->modify('+'.$date['rz9'].' hours');
        $date3->modify('+'.$date['rz10'].' minutes');
        $date3->modify('+' . $ps79 . ' minutes');

        $date1 = new DateTime(date('Y-m-d H:i:s'));
        if ($date1 < $date2 || $date1 > $date3) {
            $disabled = 'disabled="disabled"';
        }
    }

    if($st['st45']==1) {
        $disabled = 'disabled="disabled"';
        $dateClose = new DateTime($st['st163']);
        if($dateClose<=$date2&&$ps65==1&&$date2<=$date1&&!isset($marks[$nom]))
            Elgzst::model()->nbSt45($st,$elgz1);
    }

    $key = $nom; // 0 - r3



    if($ps88==0){
        $elgzst3 = isset($marks[$key]) && $marks[$key]['elgzst3'] != 0
            ? 'checked'
            : '';

        if($elgzst3=='checked')
            $typeCheck = 0;//небыл
        else
            $typeCheck = 1;//был
    }else{
        $elgzst3 = isset($marks[$key]) && $marks[$key]['elgzst3'] != 0
            ? ''
            : 'checked';
        if($elgzst3!='checked') {
            $typeCheck = 0;//небыл
        }
        else {
            $typeCheck = 1;//был
        }
    }


    $elgzst4 = isset($marks[$key]) && $marks[$key]['elgzst4'] != 0
        ? round($marks[$key]['elgzst4'], 1)
        : '';

    $elgzst5 = isset($marks[$key]) && $marks[$key]['elgzst5'] != 0 && $marks[$key]['elgzst5']!=-1
        ? round($marks[$key]['elgzst5'], 1)
        :( isset($marks[$key]) && $marks[$key]['elgzst5']==-1?tt('Отработано'):'');

    if($typeCheck == 0)
    {
        $tooltip=tt('Отсутсвует');
        $disabled_input = 'disabled="disabled"';
        //$disabled_input_1 = 'disabled="disabled"';
    }else
    {
        $tooltip=tt('Присутсвует');
        if(!empty($elgzst4)&&$elgzst4!=''&&$elgzst4!=0)
            $disabled = 'disabled="disabled"';

        if($ps55==1&&$elgzst4==''&&$elgzst3==''&&$type_lesson==1)
        {
            if($date1>=$date2&&isset($marks[$key]['elgzst4'])) {
                $elgzst4 = round($marks[$key]['elgzst4']);
                $class_1 = '';
                $disabled = 'disabled="disabled"';
            }
        }
    }


    $class_1='';
    $class_2='';
    $disabled_input=$disabled;
    $disabled_input_1=$disabled;
    if($disabled != 'disabled="disabled"')
    {
        if($elgzst4=='')
            $class_1 = 'class="not-value"';
        if($elgzst5=='')
            $class_2 = 'class="not-value"';
    }


    $ps29 = PortalSettings::model()->findByPk(29)->ps2;
    if($ps29 == 1)
        $disabled_input_1 = 'disabled="disabled"';


    if($elgzst5!='')
        $disabled_input = 'disabled="disabled"';


    if(!$read_only)
        $elgzst3_input='<input type="checkbox" data-toggle="tooltip" data-module-nom="'.$moduleNom.'-'.$st['st1'].'" data-placement="right" data-original-title="'.$tooltip.'" '.$elgzst3.' data-name="elgzst3" '.$disabled.'>';
    else
    {
        if($typeCheck == 0)
            $elgzst3='-';
        else
            $elgzst3='+';
        $elgzst3_input='<label class="label label-warning">'.$elgzst3.'</label>';
    }
    if($type_lesson==1)
    {
        if(!$read_only){

            if($disabled_input_1 != 'disabled="disabled"') {
                if (($typeCheck == 0)||($elgzst4 <= $min && ($elgzst4 != 0 || ($ps55 == 1 && $elgzst4 == 0 && isset($marks[$key]['elgzst4']))))) {
                    $disabled_input_1 = '';
                }
                else
                    $disabled_input_1 = 'disabled="disabled"';
            }
            $elgzst4_input='<input value="'.$elgzst4.'" '.$class_1.' maxlength="5" data-module-nom="'.$moduleNom.'-'.$st['st1'].'" data-name="elgzst4" '.$disabled_input.'>';
            $elgzst5_input='<input value="'.$elgzst5.'" '.$class_2.' maxlength="5" data-module-nom="'.$moduleNom.'-'.$st['st1'].'" data-name="elgzst5" '.$disabled_input_1.'>';
        }else
        {
            $elgzst4_input='<label class="label label-success">'.$elgzst4.'</label>';
            $elgzst5_input='<label class="label label-inverse">'.$elgzst5.'</label>';
        }
    }else
    {
        $elgzst4_input='';
        if(!$read_only) {
            if($ps29!=1) {
                if($disabled == 'disabled="disabled"') {
                    $disabled_input_1 = 'disabled="disabled"';
                }else
                    $disabled_input_1 = '';
                if($disabled_input_1 != 'disabled="disabled"') {
                    if ($typeCheck == 0)
                        $disabled_input_1 = '';
                    else
                        $disabled_input_1 = 'disabled="disabled"';
                }
                $val = $elgzst5;
                if($elgzst5!='')
                    $val = 'checked';
                $elgzst5_input = '<input type="checkbox" '.$val.' data-module-nom="'.$moduleNom.'-'.$st['st1'].'" data-name="elgzst5" '.$disabled_input_1.'>';
            }else
            {
                $elgzst5_input='<label class="label label-warning">'.$elgzst5.'</label>';
            }
        }
        else
            $elgzst5_input='<label class="label label-warning">'.$elgzst5.'</label>';
    }
    if($show==0)
        $button='';
    else {
        $button = CHtml::htmlButton('<i class="icon-tag"></i>', array('class' => 'btn btn-mini btn-info btn-retake', 'data-module-nom'=>$moduleNom.'-'.$st['st1'], 'style' => 'display:none'));
        $min = Elgzst::model()->getMin();
        if (!$read_only && ($typeCheck == 0 || ($elgzst4 <= $min && ($elgzst4 != 0|| ($ps55 == 1 && ($elgzst4 == 0 && isset($marks[$key]['elgzst4'])&& $type_lesson!=0)))))) {
            if (($elgzst5 <= $min&& $type_lesson==1) || ($marks[$key]['elgzst5'] != -1 && $type_lesson==0))
                $button = CHtml::htmlButton('<i class="icon-tag"></i>', array('class' => 'btn btn-mini btn-info btn-retake', 'data-module-nom'=>$moduleNom.'-'.$st['st1'],'style' => 'display:inline'));
        }
    }
    //$show=Yii::app()->user->getState('showRetake',0);
    //if($show==0)
        //$button='';
    $pattern = <<<HTML
    <td colspan="2" data-nom="{$nom}" data-priz="{$type}"  data-elgz1="{$elgz1}" data-type-lesson="{$type_lesson}" data-r1="{$r1}" data-date="{$date_lesson}" data-gr1="{$gr1}">
        %s %s %s %s
    </td>
HTML;

    return sprintf($pattern, $elgzst3_input, $elgzst4_input, $elgzst5_input, $button);

}

function table2TrModule($date,$gr1,$st,$ps20,$ps55,$ps56,$nom,$uo1,$modules,$potoch,$sem7,$ps60)
{
    if ($st['st71']!=$sem7 && $ps60 ==1)
        return '<td colspan="4"></td>';

    if (stripos($date['r2'], '11.11.1111')!==false )
        return '<td colspan="4"></td>';

    /*if (strtotime($date['r2']) > strtotime('now'))
        return '<td colspan="4"></td>';*/

    if ($ps56 == 1 && $date['elgz4']>0)
        return '<td colspan="4"></td>';

    switch($date['elgz4']){
        case 2:

            if(!isset($modules[(int)$nom-1]))
                return '<td colspan="4">'.tt('Модуль не найден!').'</td>';
            else{
                $mark = Vmp::model()->getMarks($modules[(int)$nom-1]['vvmp1'],$st['st1'],$gr1);
                if(empty($mark))
                    return '<td colspan="4">'.tt('Модуль не найден!').'</td>';
                $ind = round($mark['vmp6'],2);
                $pot = round($mark['vmp5'],2);
                $itog = round($mark['vmp4'],2);
                $pmk = round($mark['vmp7'],2);
                $vmpv1 = $mark['vmpv1'];

                $nom_=$date['elgz3'];
                $elgz1=$date['elgz1'];
                $date_lesson=$date['r2'];
                $r1=$date['r1'];
                $vmpv6 = $mark['vmpv6'];
                $disabled = '';
                if(!empty($vmpv6)) {
                    $disabled = 'disabled="disabled"';
                    $js=<<<JS
                        $('*[data-module-nom="{$nom}-{$st['st1']}"]').prop('disabled',true);
JS;
                    Yii::app()->clientScript->registerScript('module-nom'.$nom.'-'.$st['st1'], $js, CClientScript::POS_END);

                }
                $st1 = $st['st1'];
                return sprintf(<<<HTML
                    <td class="module-tr module{$vmpv1}{$st1}">%s</td>
                    <td class="module-tr module{$vmpv1}{$st1}" data-nom-module="{$nom}" data-nom="{$nom_}" {$disabled} data-elgz1="{$elgz1}" data-r1="{$r1}" data-date="{$date_lesson}" data-gr1="{$gr1}"><input value="%s" class="module-ind"  maxlength="5" data-vmpv1="{$vmpv1}"/></td>
                    <td class="module-tr module{$vmpv1}{$st1}">%s</td>
                    <td class="module-tr module{$vmpv1}{$st1}">%s</td>
HTML
                ,$pot,$ind,$pmk,$itog);
            }
            break;
    }
    return '<td colspan="4"></td>';
}

function generateTh2($ps9,$date,$type_lesson,$ps57)
{
    if($date['elgz4']>1&&$ps57==1) {
        return sprintf('<th>%s</th><th>%s</th><th>%s</th><th>%s</th>',tt('Тек.'),tt('Инд.р.'),tt('ПМК'),tt('Итог.'));
    }
    if ($type_lesson == '0')
        return '<th></th><th></th>';
        //return '<th>'.tt('Посещение').'</th><th>'.tt('Отработка').'</th>';
    if ($ps9 == '0')
        return '<th></th><th></th>';
    $elgz5='';
    $elgz6='';
    if($date['elgz5']>0)
        $elgz5=round($date['elgz5'],1);
    if($date['elgz6']>0)
        $elgz6=round($date['elgz6'],1);

    $pattern = <<<HTML
<th><input value="{$elgz5}" maxlength="3" placeholder="min" data-name="elgz5" data-elgz1="{$date['elgz1']}"></th>
<th><input value="{$elgz6}" maxlength="3" placeholder="max" data-name="elgz6" data-elgz1="{$date['elgz1']}"></th>
HTML;

    return sprintf($pattern);
}

function generateColumnName($date,$type_lesson,$ps57,$ps59)
{
    if($date['elgz4']>1&&$ps57==1) {
        $pattern = <<<HTML
	<th colspan="4">
	    <i class="icon-hand-right icon-animated-hand-pointer blue"></i>
        <span data-rel="popover" class="nom%s" data-placement="top" data-content="%s" class="green">%s</span>
    </th>
HTML;
    }else {
        $pattern = <<<HTML
	<th colspan="2">
	    <i class="icon-hand-right icon-animated-hand-pointer blue"></i>
        <span data-rel="popover" class="nom%s" data-placement="top" data-content="%s" class="green">%s</span>
    </th>
HTML;
    }

    switch($date['elgz4'])
    {
        case '0':
            $type='';
            break;
        case '1':
            $type=tt('Субмодуль');
            break;
        case '2':
            $type=tt('ПМК');
            break;
        default:
            $type='';
    }
    $type=' '.$type;
    $us4=SH::convertUS4(1);
    if($type_lesson!=0)
    $us4=SH::convertUS4($date['us4']);
    $name = '№'.$date['elgz3'].' '.$date['formatted_date'].' '.$us4.$type;
    if($ps59==1)
        $name.= ' '.$date['k2'];

    return sprintf($pattern,$date['elgz3'],$date['ustem5'], $name);
}

function countMarkTotal($marks)
{
    $total = 0;
    $count = 0;
    foreach ($marks as $mark) {
        $m = $mark['elgzst5'] != 0
            ? $mark['elgzst5']
            : $mark['elgzst4'];
        $total += $m;
        if($m>0)
            $count++;
    }
    return array($total,$count);
}


    $url       = Yii::app()->createUrl('/journal/insertStMark');
    $url_check = Yii::app()->createUrl('/journal/checkCountRetake');
    $minMaxUrl = Yii::app()->createUrl('/journal/insertMinMaxMark');
    $urlRetake = Yii::app()->createUrl('/journal/journalRetake');
    $urlModule= Yii::app()->createUrl('/journal/updateVmp');

    $table = <<<HTML
<div class="{$classTable2}" data-ps33="{$ps33}" data-gr1="{$gr1}" data-url-module="{$urlModule}" data-url="{$url}" data-url-retake="{$urlRetake}" data-url-check="{$url_check}">
    <table class="table table-striped table-bordered table-hover journal_table">
        <thead>
            <tr>
                %s
            </tr>
            <tr class="min-max" data-url="{$minMaxUrl}">
                %s
            </tr>
        </thead>
        <tbody>
            %s
        </tbody>
    </table>
</div>
HTML;

    $sem7 = Gr::model()->getSem7ByGr1ByDate($gr1,date('d.m.Y'));
    $ps59 = PortalSettings::model()->findByPk(59)->ps2;
    $ps60 = PortalSettings::model()->findByPk(60)->ps2;
    $ps65 = PortalSettings::model()->findByPk(65)->ps2;
    $ps66 = PortalSettings::model()->findByPk(66)->ps2;

    $min = Elgzst::model()->getMin();
    $elgz1_arr=array();
    $th = $th2 = $tr = '';

    global $total_1, $total_count_1;
    global $count_dates;
    $count_dates=0;
    //$column = 1;
    $elgz3Nom = 1;
    $dateDiff = -1;
    $date1 = new DateTime(date('Y-m-d H:i:s'));

    foreach($dates as $date) {
            $th .= generateColumnName($date, $model->type_lesson,$ps57,$ps59);
            $th2 .= generateTh2($ps9, $date, $model->type_lesson,$ps57);
            array_push($elgz1_arr, $date['elgz1']);
            //$column++;

            $date2  = new DateTime($date['r2']);
            $diff = $date1->diff($date2)->days;
            if ($diff <= $dateDiff || $dateDiff==-1)
            {
                $dateDiff = $diff;
                $elgz3Nom = $date['elgz3'];
            }
            $count_dates++;
    }

    $permLesson=Elgr::model()->getList($gr1,$elgz1_arr);

    foreach($students as $st) {
        $potoch = 0;
        $moduleNom=1;
        $st1 = $st['st1'];
        $marks = $elg->getMarksForStudent($st1);
        $tr .= '<tr data-st1="'.$st1.'">';
        list($total_1[$st1], $total_count_1[$st1]) = countMarkTotal($marks);
        foreach($dates as $key => $date) {
            if($date['elgz4']>1&&$ps57==1)
            {
                $tr .= table2TrModule($date,$gr1,$st,$ps20,$ps55,$ps56,$moduleNom,$uo1,$modules,$potoch,$sem7,$ps60);
                $potoch = 0;
                $moduleNom++;
            }else {
                $tr .= table2Tr($date, $gr1, $st, $marks, $permLesson, $read_only, $model->type_lesson, $ps20, $ps55, $ps56,$sem7,$ps60,$min,$ps65,$ps66,$moduleNom, $ps88);
                $potoch+=getMarsForElgz3($date['elgz3'],$marks);
            }
        }
        $tr .= '</tr>';
    }

    echo sprintf($table, $th, $th2, $tr); // 2 table
    if($elgz3Nom>1)
    Yii::app()->clientScript->registerScript('journal-scroll', <<<JS
        /*alert($('.journal_div_table2 .nom{$elgz3Nom}').position().left);
        alert($('.journal_div_table2').position().left);*/
        $(".journal_div_table2 ").animate({
            scrollLeft:$('.journal_div_table2 .nom{$elgz3Nom}').position().left - $('.journal_div_table2').position().left
        }, 750);

JS
    , CClientScript::POS_END);


