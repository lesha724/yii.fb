<?php
/**
 * Created by PhpStorm.
 * User: Neff
 * Date: 11.02.2016
 * Time: 10:45
 */

function getCellStName($st)
{
    $cell = <<<HTML
        <td  data-container="body" data-toggle="popover" data-placement="right" data-content="%s">%s</td>
HTML;
    return sprintf($cell,$st['st2'].' '.$st['st3'].' '.$st['st4'],ShortCodes::getShortName($st['st2'], $st['st3'], $st['st4']));
}
function table2Tr($date,$gr1,$st,$marks,$permLesson,$read_only,$type_lesson,$ps20,$ps55,$ps56)
{
    if (stripos($date['r2'], '11.11.1111')!==false )
        return '<td colspan="4"></td>';

    if (strtotime($date['r2']) > strtotime('now'))
        return '<td colspan="4"></td>';

    if ($ps56 == 1 && $date['elgz4']>0)
        return '<td colspan="4"></td>';

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

    $date1  = new DateTime(date('Y-m-d H:i:s'));
    $date2  = new DateTime($date_lesson);
    if (! empty($ps2)&&!isset($permLesson[$elgz1])) {
        $diff = $date1->diff($date2)->days;
        if ($diff > $ps2)
        {
            $disabled = 'disabled="disabled"';
        }
    }

    if($st['st45']==1)
        $disabled = 'disabled="disabled"';
    if($read_only)
        $disabled = 'disabled="disabled"';
    $key = $nom; // 0 - r3

    $elgzst3 = isset($marks[$key]) && $marks[$key]['elgzst3'] != 0
        ? 'checked'
        : '';

    $elgzst4 = isset($marks[$key]) && $marks[$key]['elgzst4'] != 0
        ? round($marks[$key]['elgzst4'], 1)
        : '';

    $elgzst5 = isset($marks[$key]) && $marks[$key]['elgzst5'] != 0 && $marks[$key]['elgzst5']!=-1
        ? round($marks[$key]['elgzst5'], 1)
        :( isset($marks[$key]) && $marks[$key]['elgzst5']==-1?tt('Отработано'):'');

    $disabled_input=$disabled;
    $disabled_input_1=$disabled;

    if($elgzst3=='checked')
    {
        $disabled_input = 'disabled="disabled"';
        $disabled_input_1 = 'disabled="disabled"';
    }else
    {
        if(!empty($elgzst4)&&$elgzst4!=''&&$elgzst4!=0)
            $disabled = 'disabled="disabled"';
    }

    $ps29 = PortalSettings::model()->findByPk(29)->ps2;
    if($ps29 == 1)
        $disabled_input_1 = 'disabled="disabled"';

    if($elgzst5!='')
        $disabled_input = 'disabled="disabled"';

    $elgzst3_input='<input type="checkbox" id="checkbox-'.$elgz1.'-'.$st['st1'].'-0" class="checkbox-custom" name="elgzst3" '.$elgzst3.' '.$disabled.'>
                    <label for="checkbox-'.$elgz1.'-'.$st['st1'].'-0" class="checkbox-custom-label"> </label>';
    $class_td_elgzst5 ='input-td';
    if($type_lesson==1)
    {
            if($ps55==1&&$elgzst4==''&&$elgzst3=='')
            {
                if($date1>=$date2&&isset($marks[$key]['elgzst4']))
                    $elgzst4 = round($marks[$key]['elgzst4']);
            }
            $elgzst4_input='<input value="'.$elgzst4.'" maxlength="3" type="number" data-name="elgzst4" '.$disabled_input.'>';
            $elgzst5_input='<input value="'.$elgzst5.'" maxlength="3" type="number" data-name="elgzst5" '.$disabled_input_1.'>';
    }else
    {
        $elgzst4_input='';
            if($ps29!=1) {
                if($disabled == 'disabled="disabled"') {
                    $disabled_input_1 = 'disabled="disabled"';
                }else
                    $disabled_input_1 = '';
                if($disabled_input_1 != 'disabled="disabled"') {
                    if ($elgzst3 == 'checked')
                        $disabled_input_1 = '';
                    else
                        $disabled_input_1 = 'disabled="disabled"';
                }
                $val = $elgzst5;
                if($elgzst5!='')
                    $val = 'checked';
                $elgzst5_input = '<input type="checkbox" id="checkbox-'.$elgz1.'-'.$st['st1'].'-1" class="checkbox-custom" name="elgzst5" '.$disabled_input_1.' '.$val.'>
                                    <label for="checkbox-'.$elgz1.'-'.$st['st1'].'-1" class="checkbox-custom-label"> </label>';
                $class_td_elgzst5 ='checkbox-td';
            }else
            {
                $elgzst5_input='<label class="label label-warning">'.$elgzst5.'</label>';
            }
    }

    /*$button=CHtml::htmlButton('<i class="icon-tag"></i>',array('class'=>'btn btn-mini btn-info btn-retake','style'=>'display:none'));
    $min =Elgzst::model()->getMin();
    if(!$read_only&&($elgzst3=='checked'||$elgzst4<=$min&&$elgzst4!=0))
    {
        if($elgzst5<=$min&&$elgzst5!=-1)
            $button=CHtml::htmlButton('<i class="icon-tag"></i>',array('class'=>'btn btn-mini btn-info btn-retake','style'=>'display:inline'));
    }
    $show=Yii::app()->user->getState('showRetake',0);
    if($show==0)*/
        $button='';
    $cell = <<<HTML
    <td class="%s" data-number="{$nom}" data-priz="{$type}"  data-elgz1="{$elgz1}" data-type-lesson="{$type_lesson}" data-r1="{$r1}" data-date="{$date_lesson}" data-gr1="{$gr1}">
        %s
    </td>
HTML;
    $pattern = <<<HTML
        %s %s %s %s
HTML;
    $elgzst3_input = sprintf($cell,'checkbox-td',$elgzst3_input);
    $elgzst4_input = sprintf($cell,'input-td',$elgzst4_input);
    $elgzst5_input = sprintf($cell,$class_td_elgzst5,$elgzst5_input);
    $button = sprintf($cell,'action-td',$button);
    return sprintf($pattern, $elgzst3_input, $elgzst4_input, $elgzst5_input, $button);

}

function table2TrModule($date,$gr1,$st,$ps20,$ps55,$ps56,$nom,$uo1,$modules,$potoch,$sem7,$ps60)
{
    if ($st['st71']!=$sem7 && $ps60 ==1)
        return '<td colspan="4"></td>';

    if (stripos($date['r2'], '11.11.1111')!==false )
        return '<td colspan="4"></td>';

    if ($ps56 == 1 && $date['elgz4']>0)
        return '<td colspan="4"></td>';

    switch($date['elgz4']){
        case 2:

            if(!isset($modules[$nom]))
                return '<td colspan="4">'.tt('Модуль не найден!').'</td>';
            else{
                $mark = Vmp::model()->getMarks($modules[$nom]['vmpv1'],$st['st1']);
                $ind = !empty($mark)?$mark['vmp6']:'';
                $itog = !empty($mark)?$mark['vmp4']:'';
                $pmk = !empty($mark)?$mark['vmp7']:'';
                return sprintf('<td>%s</td><td>%s</td><td>%s</td><td>%s</td>',$potoch,$ind,$pmk,$itog);
            }
            break;
    }
    return '<td colspan="4"></td>';
}

function getMarsForElgz3($nom,$marks){
    if(isset($marks[$nom])) {
        $m = $marks[$nom]['elgzst5'] != 0
            ? $marks[$nom]['elgzst5']
            : $marks[$nom]['elgzst4'];
        return  $m;
    }
    return 0;
}

function generateTh2($ps9,$date,$type_lesson,$ps57)
{
    $nom = $date['elgz3'];
    if($date['elgz4']>1&&$ps57==1) {
        return sprintf('
            <th data-number="'.$nom.'">%s</th>
            <th data-number="'.$nom.'">%s</th>
            <th data-number="'.$nom.'">%s</th>
            <th data-number="'.$nom.'">%s</th>',tt('Тек.'),tt('Инд.р.'),tt('ПМК'),tt('Итог.'));
    }
    return '<th data-number="'.$nom.'"></th><th data-number="'.$nom.'"></th><th data-number="'.$nom.'"></th><th data-number="'.$nom.'"></th>';
}

function generateColumnName($date,$type_lesson,$ps57, $ps59)
{
    $pattern = <<<HTML
	<th data-number="%s" data-date="%s" colspan="4" data-container="body" data-toggle="popover" data-placement="top" data-content="%s">
	    %s
    </th>
HTML;
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
    return sprintf($pattern,$date['elgz3'],$date['formatted_date'],$date['ustem5'], $name);
}

$url       = Yii::app()->createUrl('/journal/insertStMark');
$url_check = Yii::app()->createUrl('/journal/checkCountRetake');
$minMaxUrl = Yii::app()->createUrl('/journal/insertMinMaxMark');
$urlRetake = Yii::app()->createUrl('/journal/journalRetake');

$table = <<<HTML
    <table class="table table-bordered table-condensed journal-table" data-gr1="{$gr1}" data-url="{$url}" data-url-retake="{$urlRetake}" data-url-check="{$url_check}">
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
HTML;

$ps59 = PortalSettings::model()->findByPk(59)->ps2;
$ps60 = PortalSettings::model()->findByPk(60)->ps2;

$elgz1_arr=array();
$th = $th2 = $tr = '';
$th = '<th></th>';
$th2 ='<th></th>';

foreach($dates as $date) {
    $th .= generateColumnName($date, $model->type_lesson,$ps57,$ps59);
    $th2 .= generateTh2($ps9, $date, $model->type_lesson,$ps57);
    array_push($elgz1_arr, $date['elgz1']);
}

$permLesson=Elgr::model()->getList($gr1,$elgz1_arr);

foreach($students as $st) {
    $potoch = 0;
    $moduleNom=1;
    $st1 = $st['st1'];
    $marks = $elg->getMarksForStudent($st1);
    $tr .= '<tr data-st1="'.$st1.'">';
    $tr .= getCellStName($st);
    foreach($dates as $key => $date) {
        if($date['elgz4']>1&&$ps57==1)
        {
            /*$tr .= table2TrModule($date,$gr1,$st,$ps20,$ps55,$ps56,$moduleNom,$uo1,$modules,$potoch);
            $potoch = 0;
            $moduleNom++;*/
        }else {
            $tr .= table2Tr($date, $gr1, $st, $marks, $permLesson, $read_only, $model->type_lesson, $ps20, $ps55, $ps56);
            $potoch+=getMarsForElgz3($date['elgz3'],$marks);
        }
    }
    $tr .= '</tr>';
}

echo sprintf($table, $th, $th2, $tr); // 2 table