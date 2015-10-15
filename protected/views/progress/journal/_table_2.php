<?php
function table2Tr($date,$gr1,$st1,$marks,$permLesson,$read_only)
{
    /*if($date['priz']!=0)
       return '<td colspan="2"></td>'; */
    if (strtotime($date['r2']) > strtotime('now'))
        return '<td colspan="2"></td>';

    $us1=$date['us1'];
    $us=Us::model()->findByPk($us1);
    if($us!=null)
    {

        $r2  = $date['r2'];
        $r1  = '';
        if(isset($date['r1']))
            $r1  = $date['r1'];
        $ps2 = PortalSettings::model()->getSettingFor(27);
        $nom=$date['nom'];
        $date_lesson=$date['r2'];
        $disabled = null;
        $type=$date['priz'];
        if(isset($permLesson[$date['r2']]))
            if(strtotime($permLesson[$date['r2']]) <= strtotime('yesterday'))
            {
                $disabled = 'disabled="disabled"';
            }else
            {
                $disabled = '';
            }

        if (! empty($ps2)&&!isset($permLesson[$date['r2']])) {
            $date1  = new DateTime(date('Y-m-d H:i:s'));
            $date2  = new DateTime($date['r2']);
            $diff = $date1->diff($date2)->days;
            if ($diff > $ps2)
            {

                    $disabled = 'disabled="disabled"';
            }
        }
        $key = $us1.'/'.$date['nom']; // 0 - r3

        $stegn4 = isset($marks[$key]) && $marks[$key]['stegn4'] != 0
                    ? 'checked'
                    : '';

        $stegn5 = isset($marks[$key]) && $marks[$key]['stegn5'] != 0
                    ? round($marks[$key]['stegn5'], 1)
                    : '';

        $stegn6 = isset($marks[$key]) && $marks[$key]['stegn6'] != 0 && $marks[$key]['stegn6']!=-1
                    ? round($marks[$key]['stegn6'], 1)
                    :( isset($marks[$key]) && $marks[$key]['stegn6']==-1?tt('Отработано'):'');

        /*$stegr=Stegr::model()->findByAttributes(array('stegr1'=>$gr1,'stegr2'=>$us1,'stegr3'=>$date['r2']));
        if(!empty($stegr))
        {
            if(strtotime($stegr->stegr4)<strtotime('now'))
                $disabled='disabled="disabled"';
            else
                $disabled='';
        }*/
        $disabled_input=$disabled;
        $disabled_input_1=$disabled;
        $class_1='';
        $class_2='';
        if($stegn4=='checked')
        {
            $tooltip=tt('Отсутсвует');
            $disabled_input = 'disabled="disabled"';
            $disabled_input_1 = 'disabled="disabled"';
        }else
        {
            $tooltip=tt('Присутсвует');
            if(!empty($stegn5)&&$stegn5!=''&&$stegn5!=0)
            {
                $disabled = 'disabled="disabled"';
            }
        }
        if($disabled != 'disabled="disabled"')
        {
            if($stegn5=='')
                $class_1 = 'class="not-value"';
            if($stegn6=='')
                $class_2 = 'class="not-value"';
        }
        if(PortalSettings::model()->findByPk(29)->ps2==1)
        {
           $disabled_input_1 = 'disabled="disabled"';
        }

        if($us->us4!=1)
        {
            if(!$read_only)
                $pattern= <<<HTML
                    <td colspan="2" data-nom="{$nom}" data-priz="{$type}" data-us1="{$us1}" data-r1="{$r1}" data-date="{$date_lesson}" data-gr1="{$gr1}">
                        <input type="checkbox" data-toggle="tooltip" data-placement="right" data-original-title="{$tooltip}" %s data-name="stegn4" {$disabled}>
                        <input value="%s" {$class_1} maxlength="3" data-name="stegn5" {$disabled_input}>
                        <input value="%s" {$class_2} maxlength="3" data-name="stegn6" {$disabled_input_1}>
                    </td>
HTML;
            else
            {
                if($stegn4=='checked')
                {
                    $stegn4='-';
                }else
                {
                    $stegn4='+';
                }
                $pattern= <<<HTML
                    <td colspan="2">
                        <label class="label label-warning">%s</label>
                        <label class="label label-success">%s</label>
                        <label class="label label-inverse">%s</label>
                    </td>
HTML;
            }


            return sprintf($pattern, $stegn4, $stegn5, $stegn6);
        }else
        {
            if(!$read_only)
                $pattern= <<<HTML
            <td colspan="2" data-nom="{$nom}" data-priz="{$type}" data-us1="{$us1}" data-r1="{$r1}"  data-date="{$date_lesson}" data-gr1="{$gr1}">
                <input data-toggle="tooltip" data-placement="right" data-original-title="{$tooltip}" type="checkbox" %s data-name="stegn4" {$disabled}>
                <label class="label label-warning">%s</label>
            </td>
HTML;
            else
            {
                if($stegn4=='checked')
                {
                    $stegn4='-';
                }else
                {
                    $stegn4='+';
                }
                $pattern= <<<HTML
                    <td colspan="2">
                        <label class="label label-warning">%s</label><label class="label label-warning">%s</label>
                    </td>
HTML;
            }

            return sprintf($pattern, $stegn4,$stegn6);
        }

    }
}

function getMarksForTotalSubModule($date,$us1,$marks)
{
    $key = $us1.'/'.$date['nom']; // 0 - r3

    $stegn5 = isset($marks[$key]) && $marks[$key]['stegn5'] != 0
                ? round($marks[$key]['stegn5'], 1)
                : 0;

    $stegn6 = isset($marks[$key]) && $marks[$key]['stegn6'] != 0
                ? round($marks[$key]['stegn6'], 1)
                : 0;
    if($stegn6!=0)
        return $stegn6;
    else {
        return $stegn5;
    }
}

function generateTh2($us1,$minMax, $column, $ps9,$us4)
{
    if ($ps9 == '0')
        return '<th></th><th></th>';
    if($us4==1)
        return '<th></th><th></th>';
    if(!isset($minMax[$column]))
    {
        $mmbj4 ='';
        $mmbj5 =''; 
        //$mmbj1 ='-1';
    }  else {
        $marks = $minMax[$column];
        //$mmbj1 = $marks['mmbj1'];
        $mmbj4 = round($marks['mmbj4'], 1);
        $mmbj5 = round($marks['mmbj5'], 1);  
    }
    

    $pattern = <<<HTML
<th><input value="{$mmbj4}" maxlength="3" placeholder="min" data-name="mmbj4" data-mmbj2="{$us1}" data-mmbj3="{$column}"></th>
<th><input value="{$mmbj5}" maxlength="3" placeholder="max" data-name="mmbj5" data-mmbj2="{$us1}" data-mmbj3="{$column}"></th>
HTML;

    return sprintf($pattern);
}

function getSubModulesMark($date, $marks)
{
    $us1=$date['us1'];
    $key = $us1.'/'.$date['nom']; // 0 - r3
    if(isset($marks[$key]))
    {
        $mark = $marks[$key]['stegn6'] != 0
                    ? $marks[$key]['stegn6']
                    : $marks[$key]['stegn5'];
    }  else {
        return 0;
    }
    return $mark;
}

function countSTEGTotal($marks)
{
    $total = 0;
    foreach ($marks as $mark) {
        $total += $mark['stegn6'] != 0
                    ? $mark['stegn6']
                    : $mark['stegn5'];
    }
    return $total;
}

function countTotal1($ps20, $dates, $marks, $pbal)
{
    $res = 0;
    if ($ps20 == 0)
        $res = countSTEGTotal($marks);
    else {
        $subModuleMarks = array();
        
        foreach($dates as $date) {
            if ($date['priz'] == 1) // is sub module?
                $subModuleMarks[count($subModuleMarks)] = getSubModulesMark($date, $marks);
        }
        if (! empty($subModuleMarks)) {
            //$res = (string)round(array_sum($subModuleMarks)/count($subModuleMarks), 1);
            $res = (string)round(array_sum($subModuleMarks));
            /*if (isset($pbal[$res]))
                $res = $pbal[$res];*/
        }
    }

    return $res;
}

function generateColumnName($date, $ps20)
{
    $type='';
    if ($ps20 == 1 && $date['priz'] == 1)
    {
        $pattern = <<<HTML
<th colspan="2" data-submodule="true">
    <i class="icon-hand-right icon-animated-hand-pointer blue"></i>
    <span data-rel="popover" data-placement="top" data-content="{$date['tema']}" class="green">%s</span>
</th>
HTML;
        $type=' '.tt('Субмодуль');
    }else { 
    if($ps20 == 1 && $date['priz'] == 2)
    {
        $pattern = <<<HTML
<th colspan="2" data-submodule="true">
    <i class="icon-hand-right icon-animated-hand-pointer blue"></i>
    <span data-rel="popover" data-placement="top" data-content="{$date['tema']}" class="green">%s</span>
</th>
HTML;
        $type=' '.tt('Модуль');
    }
    else
        $pattern = <<<HTML
	<th colspan="2"><i class="icon-hand-right icon-animated-hand-pointer blue"></i>
    <span data-rel="popover" data-placement="top" data-content="{$date['tema']}" class="green">%s</span></th>
HTML;
     
 }


    $name = '№'.$date['nom'].' '.$date['formatted_date'].SH::convertUS4($date['us4']).$type;

    return sprintf($pattern, $name);
}
    $url       = Yii::app()->createUrl('/progress/insertStegMark');
    $url_check       = Yii::app()->createUrl('/progress/checkCountRetake');
    $minMaxUrl = Yii::app()->createUrl('/progress/insertMmbjMark');
    $table_class='journal_div_table2';
    /*if($us->us4==1)
    {*/
        $table_class='journal_div_table2 journal_div_table2_1';
    //}
    $table = <<<HTML
<div class="{$table_class}" data-ps33="{$ps33}" data-gr1="{$gr1}" data-url="{$url}" data-url-check="{$url_check}">
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



    $minMax = Mmbj::model()->getDataForJournal($us1_arr);
    $permLesson=Stegr::model()->getList($gr1,$us1_arr);
    global $count_dates;
    $count_dates=0;
/*** 2 table ***/
    $th = $th2 = $tr = '';
    $column = 1;
    foreach($dates as $date) {
        $th    .= generateColumnName($date, $ps20);
        $th2   .= generateTh2($date['us1'],$minMax, $column, $ps9,$date['us4']);
        $column++;
        $count_dates++;
    }

    global $total_1;

    foreach($students as $st) {

        $st1 = $st['st1'];
        $marks = Stegn::model()->getMarksForStudent($st1, $us1_arr);
        $tr .= '<tr data-st1="'.$st1.'">';
        $total_1[$st1] = countTotal1($ps20, $dates, $marks, $pbal);
        //$total_sub_module=0;
        foreach($dates as $key => $date) {
            /*if($date['priz']==0)
            {
                $tr .= table2Tr($date,$us1,$gr1,$st1,$marks);
                $total_sub_module+=getMarksForTotalSubModule($date,$us1,$marks);
            }  else {
                if($date['priz']==1)
                {
                    $tr .='<td colspan="2">'.$total_sub_module.'</td>';
                    $total_sub_module=0;
                }
            }*/
            $tr .= table2Tr($date,$gr1,$st1,$marks,$permLesson,$read_only);
            
        }
        $tr .= '</tr>';
    }

    echo sprintf($table, $th, $th2, $tr); // 2 table


