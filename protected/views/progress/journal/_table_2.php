<?php
function table2Tr($date,$us1,$gr1,$st1,$marks)
{
    /*if($date['priz']!=0)
       return '<td colspan="2"></td>'; */
    if (strtotime($date['r2']) > strtotime('now'))
        return '<td colspan="2"></td>';

    $r2  = $date['r2'];
    $ps2 = PortalSettings::model()->getSettingFor(27);
    $nom=$date['nom'];
    $disabled = null;
    $type=$date['priz'];

    if (! empty($ps2)) {
        $date1  = new DateTime(date('Y-m-d H:i:s'));
        $date2  = new DateTime($date['r2']);
        $diff = $date1->diff($date2)->days;
        if ($diff > $ps2)
            $disabled = 'disabled="disabled"';
    }

    $pattern= <<<HTML
    <td colspan="2" data-nom="{$nom}" data-priz="{$type}" data-us1="{$us1}" data-gr1="{$gr1}">
        <input type="checkbox" %s data-name="stegn4" {$disabled}>
        <input value="%s" maxlength="3" data-name="stegn5" {$disabled}>
        <input value="%s" maxlength="3" data-name="stegn6" {$disabled}>
    </td>
HTML;
    $key = $us1.'/'.$date['nom']; // 0 - r3

    $stegn4 = isset($marks[$key]) && $marks[$key]['stegn4'] != 0
                ? 'checked'
                : '';

    $stegn5 = isset($marks[$key]) && $marks[$key]['stegn5'] != 0
                ? round($marks[$key]['stegn5'], 1)
                : '';

    $stegn6 = isset($marks[$key]) && $marks[$key]['stegn6'] != 0
                ? round($marks[$key]['stegn6'], 1)
                : '';

    return sprintf($pattern, $stegn4, $stegn5, $stegn6);
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

function generateTh2($us1,$minMax, $column, $ps9)
{
    if ($ps9 == '0')
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

function getSubModulesMark($date, $marks,$us1)
{
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

function countTotal1($ps20, $dates, $marks, $pbal,$us1)
{
    $res = 0;
    if ($ps20 == 0)
        $res = countSTEGTotal($marks);
    else {
        $subModuleMarks = array();
        
        foreach($dates as $date) {
            if ($date['priz'] == 1) // is sub module?
                $subModuleMarks[count($subModuleMarks)] = getSubModulesMark($date, $marks,$us1);
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


    $name = $date['formatted_date'].$type;

    return sprintf($pattern, $name);
}
    $url       = Yii::app()->createUrl('/progress/insertStegMark');
    $minMaxUrl = Yii::app()->createUrl('/progress/insertMmbjMark');
    $table = <<<HTML
<div class="journal_div_table2" data-url="{$url}">
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
    
    $minMax = Mmbj::model()->getDataForJournal($us1);
    
    /*** 2 table ***/
    $th = $th2 = $tr = '';
    $column = 1;
    foreach($dates as $date) {
        $th    .= generateColumnName($date, $ps20);
        $th2   .= generateTh2($us1,$minMax, $column, $ps9);
        $column++;
    }

    global $total_1;
    
    foreach($students as $st) {

        $st1 = $st['st1'];
        $marks = Stegn::model()->getMarksForStudent($st1, $us1);
        $tr .= '<tr data-st1="'.$st1.'">';
        $total_1[$st1] = countTotal1($ps20, $dates, $marks, $pbal,$us1);
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
            $tr .= table2Tr($date,$us1,$gr1,$st1,$marks);
            
        }
        $tr .= '</tr>';
    }

    echo sprintf($table, $th, $th2, $tr); // 2 table


