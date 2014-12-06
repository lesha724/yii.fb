<?php
global $htmlOptions;
$htmlOptions = array(
    1 => array('style' => 'margin:0;width:50px;font-size:10px;height: 20px;padding:0', 'id'=>false),
    2 => array('maxlength' => 3, 'style' => 'height:10px;margin:0;width:20px', 'id'=>false),
    3 => array('maxlength' => 3, 'style' => 'height:10px;margin:0;width:15px', 'id'=>false),
    4 => array('style' => 'height:10px;margin:0;width:45px', 'class' => 'datepicker', 'id'=>false),
    5 => array('maxlength' => 15, 'style' => 'height:10px;margin:0;width:40px', 'id'=>false),
);

global $statuses;
$statuses = array(
    0  => '',
    -1 => 'Н/я',
    -2 => 'Н/д',
    -3 => 'Н/я у',
);

function tr($stus, $allStusp, $tabindex)
{
    $st1   = $stus['st1'];
    $stus0 = $stus['stus0'];

    $td1 = tdMain($stus, $tabindex);
    $td2 = tdP($stus, 0, $allStusp, $tabindex);
    $td3 = tdP($stus, 1, $allStusp, $tabindex);
    $td4 = tdP($stus, 2, $allStusp, $tabindex);

    $pattern = <<<HTML
<tr data-st1="{$st1}" data-stus0="{$stus0}">
    {$td1}
    {$td2}
    {$td3}
    {$td4}
</tr>
HTML;

    return $pattern;
}

function tdMain($stus, $tabindex)
{
    global $htmlOptions;
    global $statuses;

    //$select = CHtml::dropDownList('stus3', $stus['stus3'], $statuses, $htmlOptions[1]);

    $mark = $stus['stus3'];
    if ($stus['stus19'] == 6)
        $input1 = CHtml::checkBox('stus3', $mark == -1, array('id' => false, 'tabindex' => $tabindex));
    else {
        $mark = $mark == 0 ? '' : $mark;
        $input1 = CHtml::textField('stus3', $mark, $htmlOptions[3]+array('tabindex' => $tabindex));
    }

    $input2 = CHtml::textField('stus6', SH::formatDate('Y-m-d H:i:s', 'd.m.y', $stus['stus6']), $htmlOptions[4]);
    $input3 = CHtml::textField('stus7', $stus['stus7'], $htmlOptions[5]);

    $td1 = <<<HTML
    <td>{$input1}</td>
    <td>{$input2}</td>
    <td>{$input3}</td>
HTML;

    return $td1;
}

function tdP($stus, $i, $allStusp, $tabindex)
{
    global $htmlOptions;
    global $statuses;

    $tabindex = ($i+1) * ($tabindex+100);
    $st1   = $stus['st1'];
    $stus0 = $stus['stus0'];

    $status = isset($allStusp[$st1][$stus0][$i]) ? $allStusp[$st1][$stus0][$i]['stusp3'] : '';
    $select = CHtml::dropDownList('stusp3', $status, $statuses, $htmlOptions[1]);

    $mark = isset($allStusp[$st1][$stus0][$i]) ? $allStusp[$st1][$stus0][$i]['stusp3'] : '';

    if ($stus['stus19'] == 6)
        $input1 = CHtml::checkBox('stusp3', $mark == -1, array('id' => false, 'tabindex' => $tabindex));
    else {
        $mark = $mark <= 0 ? '' : $mark;
        $input1 = CHtml::textField('stusp3', $mark, $htmlOptions[3]+array('tabindex' => $tabindex));
    }

    $mark = isset($allStusp[$st1][$stus0][$i]) ? SH::formatDate('Y-m-d H:i:s', 'd.m.y', $allStusp[$st1][$stus0][$i]['stusp6']) : '';
    $input2 = CHtml::textField('stusp6', $mark, $htmlOptions[4]);

    $mark = isset($allStusp[$st1][$stus0][$i]) ? $allStusp[$st1][$stus0][$i]['stusp7'] : '';
    $input3 = CHtml::textField('stusp7', $mark, $htmlOptions[5]);

    $td1 = <<<HTML
    <td data-stusp5="{$i}">{$select}</td>
    <td data-stusp5="{$i}">{$input1}</td>
    <td data-stusp5="{$i}">{$input2}</td>
    <td data-stusp5="{$i}">{$input3}</td>
HTML;

    return $td1;
}


function getAllSt1($students)
{
    $res = array();
    foreach($students as $st) {
        $res[] = $st['st1'];
    }
    return $res;
}

    $text1 = tt('Дата');
    $text2 = tt('№ вед.');
    $url   = Yii::app()->createUrl('progress/insertStus');
    $k1    = $params['stus21'];
    $cxmb0 = $params['cxmb0'];

    $table = <<<HTML
<table data-url="{$url}" data-k1="{$k1}" data-cxmb0="{$cxmb0}" class="table table-striped table-bordered table-hover small-rows exam-session-table-2 tr-h-25" >
    <thead>
        <tr>
            <th colspan="3">%s</th>
            <th colspan="4">%s</th>
            <th colspan="4">%s</th>
            <th colspan="4">%s</th>
        </tr>
        <tr>
            <th>100</th>
            <th>{$text1}</th>
            <th>{$text2}</th>
            <th></th>
            <th>100</th>
            <th>{$text1}</th>
            <th>{$text2}</th>
            <th></th>
            <th>100</th>
            <th>{$text1}</th>
            <th>{$text2}</th>
            <th></th>
            <th>100</th>
            <th>{$text1}</th>
            <th>{$text2}</th>
        </tr>
    </thead>
    <tbody>
        %s
    </tbody>
</table>
HTML;

    $allSt1   = getAllSt1($students);
    $allStusp = Stusp::model()->getAllStusP($allSt1);

    $tr = '';
    $tabindex = 1;
    foreach($students as $key => $stus) {
        $tr .= tr($stus, $allStusp, $tabindex);
        $tabindex++;
    }
    echo sprintf($table, tt('Основная сдача'), tt('Несдача основная'), tt('Пересдача 1'), tt('Пересдача 2'), $tr);


