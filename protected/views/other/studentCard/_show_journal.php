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
                    </thead>
                    <tbody>
                        %s
                    </tbody>
                </table>
HTML;
        $th = $tr = '';

        foreach($dates as $date) {
            $th .= generateColumnName($date, $type, $ps59);
            $tr .= tableRow($date,$st,$marks,$type, $ps56,$discipline['sem7'],$ps60,$ps55);
        }
        echo '<div class="table-responsive">';
        echo sprintf($table, $th, $tr); // 2 table
        echo '</div>';
    }
}
