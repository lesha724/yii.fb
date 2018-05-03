<?php
$uo1= $discipline['uo1'];
$sem1=$discipline['sem1'];
$type = $discipline['type_journal'];
$elg1=Elg::getElg1($uo1,$type,$sem1);
$elg = Elg::model()->findByPk($elg1);
if(empty($elg))
    echo tt('Не задана структура журнала. Обратитесь к Администратору системы').'.';
else {
    $marks = $elg->getMarksForStudent($st->st1);

    $ps9 = PortalSettings::model()->getSettingFor(9);

    $ps57 = PortalSettings::model()->getSettingFor(57);
    $modules = null;
    if($ps57==1)
        $modules = Vvmp::model()->getModule($uo1,$gr1);

    $dates = R::model()->getDatesForJournal(
        $uo1,
        $gr1,
        $type,
        $sem1
    );
    if (count($dates) == 0)
        echo tt('Не найдены занятия.');
    else {
        $table = <<<HTML
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            %s
                        </tr>
                        %s
                    </thead>
                    <tbody>
                        %s
                    </tbody>
                </table>
HTML;
        $th = $th2 = $tr = '';

        $th.= '<th>'.tt('Занятие'). '</th>';
        $tr.='<tr>'.'<th>'.tt('Оценки'). '</th>';

        $minMax = $ps9 == 1;
        if($minMax) {
            $th2 .= '<tr>';
            $th2 .= '<th>'.tt('Мин&nbsp;|&nbsp;Мах'). '</th>';
        }

        $moduleNom=1;
        foreach($dates as $date) {
            $th .= generateColumnName($date, $type, $ps59);

            if($date['elgz4']>1&&$ps57==1) {
                $tr .='<td colspan="4"></td>';
            }elseif(($date['elgz4']==3||$date['elgz4']==4||$date['elgz4']==5)&&$ps57==1){
                if($date['elgz4']==3) {
                    $tr.='<th></th><th></th>';
                }else
                    $tr.='<th></th><th></th>';
            }else {
                $tr .= tableRow($date, $st, $marks, $type, $ps56, $discipline['sem7'], $ps60, $ps55);
                if($minMax){
                    if ($type == 0)
                        $th2.= '<th></th><th></th>';
                    else {
                        $elgz5 = '0';
                        $elgz6 = '0';
                        if ($date['elgz5'] > 0)
                            $elgz5 = round($date['elgz5'], 1);
                        if ($date['elgz6'] > 0)
                            $elgz6 = round($date['elgz6'], 1);

                        /*if(!empty($elgz5)|| !empty($elgz6))
                        {
                            if(empty($elgz5))
                                $elgz5 = 0;

                            if(empty($elgz6))
                                $elgz6 = 0;
                        }*/

                        $th2.='<th>'.$elgz5.'</th><th>'.$elgz6.'</th>';
                    }
                }
            }
        }


        if($minMax)
            $th2.='</tr>';
        $tr.='</tr>';

        echo '<div class="table-responsive">';
        echo sprintf($table, $th, $th2, $tr); // 2 table
        echo '</div>';
    }
}
