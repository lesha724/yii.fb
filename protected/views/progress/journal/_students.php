<?php
/*
 * @var $model JournalForm
 */





    $table_1_tr = <<<HTML
<tr><td class="center">%s</td><td>%s</td></tr>
HTML;

    $columnName = tt('ФИО');
    $table_1 = <<<HTML
    <table class="table table-striped table-bordered table-hover journal_table journal_table_1" >
        <thead>
            <tr>
                <th class="center">№</th>
                <th>{$columnName}</th>
            </tr>
        </thead>
        <tbody>
            %s
        </tbody>
    </table>
HTML;

    $table_2 = <<<HTML
<div class="journal_div_table2">
    <table class="table table-striped table-bordered table-hover journal_table">
        <thead>
            <tr>
                %s
            </tr>
        </thead>
        <tbody>
            %s
        </tbody>
    </table>
</div>
HTML;



if (! empty($model->group)):

    $dates = R::model()->getDatesForJournal(
        Yii::app()->user->dbModel->p1,
        $model->discipline,
        Yii::app()->session['year'],
        Yii::app()->session['sem'],
        $model->group,
        $type
    );

    $uo1 = !empty($dates) ? $dates[0]['uo1'] : -1;
    $nr1 = !empty($dates) ? $dates[0]['nr1'] : -1;

    $students = St::model()->getStudentsForJournal($model->group, $uo1);

    /*** 1 table ***/
    $table_1_trs = '';
    foreach($students as $key => $st) {
        $name = ShortCodes::getShortName($st['st2'], $st['st3'], $st['st4']);
        $name = mb_substr($name, 0, 10);
        $num  = $key+1;

        $table_1_trs .= sprintf($table_1_tr, $num, $name);
    }
    echo sprintf($table_1, $table_1_trs); // 1 table


    /*** 2 table ***/
    $table_2_th = '';
    foreach($dates as $date)
        $table_2_th .= '<th>'.$date['formatted_date'].'</th>';


    $table_2_tr = '';
    foreach($students as $st) {

        $marks = Steg::model()->getMarksForStudent($st['st1'], $nr1);

        $table_2_tr .= '<tr data-st1="'.$st['st1'].'">';
        foreach($dates as $date) {
            $table_2_tr .= '<td data-r2="'.$date['r2'].'">'.generateTable2Tr($date, $marks).'</td>';
        }
        $table_2_tr .= '</tr>';
    }
    echo sprintf($table_2, $table_2_th, $table_2_tr); // 2 table



    $insertMarkUrl = Yii::app()->createAbsoluteUrl('/progress/insertMark');
    Yii::app()->clientScript->registerScript('journal-vars', <<<JS
        nr1 = "{$nr1}";
        insertMarkUrl = "{$insertMarkUrl}"
JS
    , CClientScript::POS_READY);


endif;


function generateTable2Tr($date, $marks)
{
    if (strtotime($date['r2']) > strtotime('now'))
        return null;

    $pattern= <<<HTML
            <input type="checkbox" %s data-name="steg6">
            <input value="%s" maxlength="3" data-name="steg5">
            <input value="%s" maxlength="3" data-name="steg9">
HTML;

    $key = $date['r2'].'/0'; // 0 - r3

    $steg6 = isset($marks[$key]) && $marks[$key]['steg6'] != 0
                ? 'checked'
                : '';

    $steg5 = isset($marks[$key]) && $marks[$key]['steg5'] != 0
                ? round($marks[$key]['steg5'], 1)
                : '';

    $steg9 = isset($marks[$key]) && $marks[$key]['steg9'] != 0
                ? round($marks[$key]['steg9'], 1)
                : '';

    return sprintf($pattern, $steg6, $steg5, $steg9);
}
