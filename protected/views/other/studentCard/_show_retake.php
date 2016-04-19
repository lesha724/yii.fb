<?php
/**
 * Created by PhpStorm.
 * User: Neff
 * Date: 13.04.2016
 * Time: 13:44
 */
    $ps55=PortalSettings::model()->findByPk(55)->ps2;
    $nb = Elg::model()->getOmissions($st1,$uo1,$sem1,$type,$gr1);
    $f = Elg::model()->getF($st1,$uo1,$sem1,$type,$gr1,$ps55);

    if(!empty($nb)):
        ?>
        <h5><?=tt('Пропуски')?></h5>
        <?php
        $table = '
            <table class="table able-bordered table-hover table-condensed">
                <thead>
                    <th>№</th>
                        <th>'.tt('Отработка').'</th>
                        <th>'.tt('Дата зан.').'</th>
                        <th>'.tt('№ зан.').'</th>
                        <th>'.tt('Тема').'</th>
                        <th>'.tt('Тип').'</th>
                        <th>'.tt('Уваж./Неув.').'</th>
                        <th class="td-elgp3">'.tt('Номер справки').'</th>
                        <th class="td-elgp2">'.tt('Тип').'</th>
                        <th class="td-elgp4">'.tt('№ квитанции (тип оплата)').'</th>
                        <th class="td-elgp5">'.tt('Дата квитанции(тип оплата)').'</th>
                </thead>
                <tbody>
                    %s
                </tbody>
            </table>';

        $pattern=<<<HTML
        <tr>
                <td>%s</td>
                <td class="retake">%s</td>
                <td class="date">%s</td>
                <td class="nom">%s</td>
                <td class="t-name">%s</td>
                <td class="type-us">%s</td>
                <td class="type-omissions">%s</td>
                <td class="td-elgp3">%s</td>
                <td class="td-elgp2">%s</td>
                <td class="td-elgp4">%s</td>
                <td class="td-elgp5">%s</td>
        </tr>
HTML;
        $tr="";
        $i=1;
        $type1=tt("Не ув.");
        $type2=tt("Уваж.");
        $typesElgp = Elgzst::model()->getTypes();
        foreach($nb as $key){
            $type = $type1;
            if ($key['elgzst3'] == 2)
                $type = $type2;
            $elgzst5="";
            if($key['elgzst5']>0){
                $elgzst5=(float)$key['elgzst5'];
            }elseif($key['elgzst5']==-1){
                $elgzst5=tt('Отработано');
            }
            $tr .= sprintf($pattern, $i,$elgzst5, date('d.m.Y', strtotime($key['r2'])),$key['elgz3'], $key['ustem5'], SH::convertUS4($key['us4']), $type, $key['elgp3'], $key['elgp2']>0?$typesElgp[$key['elgp2']]:"", $key['elgp2']==5?$key['elgp4']:"", $key['elgp2']==5?date('d.m.Y', strtotime($key['elgp5'])):"");
            $i++;
        }
        echo sprintf($table,$tr);
    endif;


    if(!empty($f)):
    ?>
        <h5><?=tt('Двойки')?></h5>
    <?php

        $table = ' <table class="table able-bordered table-hover table-condensed">
                <thead>
                    <th>№</th>
                        <th>'.tt('Оценка.').'</th>
                        <th>'.tt('Отработка').'</th>
                        <th>'.tt('Дата зан.').'</th>
                        <th>'.tt('№ зан.').'</th>
                        <th>'.tt('Тема').'</th>
                        <th>'.tt('Тип').'</th>
                </thead>
                <tbody>
                    %s
                </tbody>
            </table>';

        $pattern=<<<HTML

HTML;
        $pattern=<<<HTML
        <tr>
                <td>%s</td>
                <td class="ball">%s</td>
                <td class="retake">%s</td>
                <td class="date">%s</td>
                <td class="nom">%s</td>
                <td class="t-name">%s</td>
                <td class="type-us">%s</td>
        </tr>
HTML;
        $tr="";
        foreach($f as $key){
            if($key['elgzst5']>0){
                $elgzst5=(float)$key['elgzst5'];
            }elseif($key['elgzst5']==-1){
                $elgzst5=tt('Отработано');
            }
            $tr .= sprintf($pattern, $i,(float)$key['elgzst4'],$elgzst5, date('d.m.Y', strtotime($key['r2'])),$key['elgz3'], $key['ustem5'], SH::convertUS4($key['us4']));
        }
        echo sprintf($table,$tr);
    endif;
?>