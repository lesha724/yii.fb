<?php
/**
 * Created by PhpStorm.
 * User: Neff
 * Date: 27.11.2015
 * Time: 11:23
 */

function tableRow($date,$st,$marks,$type_lesson,$ps56,$sem7,$ps60,$ps55)
{
    if (($st['st71']!=$sem7&&$st['st71']!=$sem7+1) &&$ps60==1)
        return '<td colspan="2"></td>';

    if (stripos($date['r2'], '11.11.1111')!==false )
        return '<td colspan="2"></td>';

    if (strtotime($date['r2']) > strtotime('now'))
        return '<td colspan="2"></td>';
    if ($ps56 == 1 && $date['elgz4']>0)
        return '<td colspan="2"></td>';

    $nom=$date['elgz3'];

    $key = $nom; // 0 - r3

    $elgzst3 = isset($marks[$key]) && $marks[$key]['elgzst3'] != 0
        ? 'checked'
        : '';

    $elgzst4 = isset($marks[$key])
        ? round($marks[$key]['elgzst4'], 1)
        : '';

    if(($elgzst4==0&&$ps55!=1)||($elgzst3=='checked')){
        $elgzst4='';
    }
    $elgzst5 = isset($marks[$key]) && $marks[$key]['elgzst5'] != 0 && $marks[$key]['elgzst5']!=-1
        ? round($marks[$key]['elgzst5'], 1)
        :( isset($marks[$key]) && $marks[$key]['elgzst5']==-1?tt('Отработано'):'');

    if($elgzst3=='checked')
        $elgzst3='-';
    else
        $elgzst3='+';

    $elgzst3_input='<label class="label label-warning">'.$elgzst3.'</label>';

    if($type_lesson==1)
    {
        $elgzst4_input='<label class="label label-success">'.$elgzst4.'</label>';
        $elgzst5_input='<label class="label label-inverse">'.$elgzst5.'</label>';
    }else
    {
        $elgzst4_input='';
        $elgzst5_input = '<label class="label label-inverse">' . $elgzst5 . '</label>';
    }

    $pattern = <<<HTML
    <td colspan="2">
        %s %s %s
    </td>
HTML;

    return sprintf($pattern, $elgzst3_input, $elgzst4_input, $elgzst5_input);
}


function generateColumnName($date,$type_lesson,$ps59){
    $pattern = <<<HTML
	<th colspan="2">
	    <i class="icon-hand-right icon-animated-hand-pointer blue"></i>
        <span data-rel="popover" data-placement="bottom" data-content="%s" class="green">%s</span>
    </th>
HTML;

    $type = Ustem::model()->getUstem6Value($date['elgz4']);
    $type=' '.$type;
    $us4=SH::convertUS4(1);
    if($type_lesson!=0)
        $us4=SH::convertUS4($date['us4']);
    $name = '№'.$date['elgz3'].' '.$date['formatted_date'].' '.$us4.$type;
    if($ps59==1)
        $name.= ' '.$date['k2'];

    return sprintf($pattern,$date['ustem5'], $name);
}

?>
    <div>
        <?php /*echo tt(":")*/?>
        <label class="label label-warning">+</label> - <?= tt("Присутствовал на занятии")?>
        <label class="label label-warning">-</label> - <?= tt("Отсутствовал на занятии")?>
        <label class="label label-success">5</label> - <?= tt("Оценка за занятие")?>
        <label class="label label-inverse">5</label> - <?= tt("Отработка занятия")?>
    </div>
    <div class="accordion" id="accordion-journal">
<?php
$pattern=<<<HTML
    <div class="accordion-group">
        <div class="accordion-heading">
          <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion-journal" href="#collapse-%s">%s</a>
        </div>
        <div id="collapse-%s" class="accordion-body collapse">
            <div class="accordion-inner">
            %s
            </div>
        </div>
    </div>
HTML;

$ps59 = PortalSettings::model()->findByPk(59)->ps2;
$ps56 = PortalSettings::model()->findByPk(56)->ps2;
$ps60 = PortalSettings::model()->findByPk(60)->ps2;
$ps55 = PortalSettings::model()->findByPk(55)->ps2;

foreach ($disciplines as $discipline) {
    $id=$discipline['uo1'].'-'.$discipline['us4'];
    $name=$discipline['d2'].' ('.SH::convertUS4($discipline['us4']).') | '.tt("Семестр").' №'.$discipline['sem7'];
    $html = $this->renderPartial('studentCard/_show_journal', array(
        'discipline'=>$discipline,
        'gr1'=>$gr1,
        'st'=>$st,
        'ps59'=>$ps59,
        'ps56'=>$ps56,
        'ps60'=>$ps60,
        'ps55'=>$ps55
    ), true);
    echo sprintf($pattern,$id,$name,$id,$html);
}
?>
    </div>