<?php
/**
 * @var St $student
 * @var Sdp $models
 * @var CActiveForm $form
 */

$st1 = $student->st1;
$semesters = Sem::model()->getSemestersForSt($st1);
$allMarks  = Stus::model()->getMarksFor($st1);
$statistic = array_count_values($allMarks);

$start = 0;
$end   = 99;

$semNum = Yii::app()->request->getParam('semNum', null);
if (! is_null($semNum))
    $start = $end = $semNum;

function color($mark)
{
    if ($mark >= 5)
        $color = 'label-success';
    elseif ($mark >= 4)
        $color = 'label-yellow';
    elseif ($mark >= 3)
        $color = 'label-pink';
    else
        $color = null;

    return $color;
}

$icon = '<i class="icon-hand-right"></i> ';
?>
<div class="page-header position-relative" style="margin-top: 3%">
    <h1>
        <?=tt('Статистика успеваемости')?>
        <?php if (! is_null($semNum)) :?>
            <small>
                <i class="icon-double-angle-right"></i>
                <?=$semNum.' '.tt('семестр')?>
            </small>
        <?php endif ?>
    </h1>
</div>

<div id="marks-statistic">
    <table class="table table-striped table-bordered table-hover small-rows table-1">
        <tr>
            <td colspan="4"><?=tt('Всего')?></td>
        </tr>
        <tr class="t-a-c">
            <td class="<?=color(5)?>">5</td>
            <td class="<?=color(4)?>">4</td>
            <td class="<?=color(3)?>">3</td>
            <td><?=CHtml::link($icon.tt('Ср'), $this->createUrl('/other/employment', array('id'=>$st1, '#'=>'marks')))?></td>
        </tr>
        <tr class="t-a-c">
            <td><?=isset($statistic[5])?$statistic[5]:0?></td>
            <td><?=isset($statistic[4])?$statistic[4]:0?></td>
            <td><?=isset($statistic[3])?$statistic[3]:0?></td>
            <?php $avg = count($allMarks)>0 ? round(array_sum($allMarks)/count($allMarks), 2) : 0?>
            <td class="<?=color($avg)?>"><?=$avg?></td>
        </tr>
    </table>

    <table class="table table-striped table-bordered table-hover small-rows table-2" >
        <tr>
            <td colspan="<?=count($semesters)?>"><?=tt('Средний балл по семестрам')?></td>
        </tr>
        <tr class="t-a-c">
            <?php
                foreach ($semesters as $semester) {
                    $url   = $this->createUrl('/other/employment', array('id'=>$st1, 'semNum' => $semester, '#'=>'marks'));
                    $title = $icon.$semester;
                    $link  = CHtml::link($title, $url);
                    echo '<td>'.$link.'</td>';
                }
            ?>
        </tr>
        <tr class="t-a-c">
            <?php
                foreach ($semesters as $semester) {
                    $marks = Stus::model()->getMarksFor($st1, $semester, $semester);
                    $avg   = count($marks)>0 ? array_sum($marks)/count($marks):0;
                    $avg   = round($avg, 2);

                    echo '<td class="'.color($avg).'">'.$avg.'</td>';
                }
            ?>
        </tr>
    </table>

    <?php if (! is_null($semNum)) : ?>
        <?php
            $semMarks  = Stus::model()->getMarksFor($st1, $semNum, $semNum);
            $statistic = array_count_values($semMarks);
        ?>
    <table class="table table-striped table-bordered table-hover small-rows table-3">
        <tr>
            <td colspan="4"><?=tt('За семестр')?></td>
        </tr>
        <tr class="t-a-c">
            <td class="<?=color(5)?>">5</td>
            <td class="<?=color(4)?>">4</td>
            <td class="<?=color(3)?>">3</td>
            <td><?=tt('Ср')?></td>
        </tr>
        <tr class="t-a-c">
            <td><?=isset($statistic[5])?$statistic[5]:0?></td>
            <td><?=isset($statistic[4])?$statistic[4]:0?></td>
            <td><?=isset($statistic[3])?$statistic[3]:0?></td>
            <?php $avg = count($semMarks)>0 ? round(array_sum($semMarks)/count($semMarks), 2) : 0?>
            <td class="<?=color($avg)?>"><?=$avg?></td>
        </tr>
    </table>
    <?php endif ?>
</div>


<table id="marks" class="table table-striped table-bordered table-hover small-rows">
    <thead>
        <tr>
            <th rowspan="2">№</th>
            <th rowspan="2"><?=tt('Дисциплина')?></th>
            <th rowspan="2"><?=tt('Сем.')?></th>
            <th rowspan="2"><?=tt('Тип')?></th>
            <th colspan="3"><?=tt('Оценка')?></th>
            <th rowspan="2"><?=tt('№ ведом.')?></th>
            <th rowspan="2"><?=tt('Дата')?></th>
        </tr>
        <tr>
            <th>5</th>
            <th>ECTS</th>
            <th>100</th>
        </tr>
    </thead>

    <tbody>
    <?php
        $disciplines = Stus::model()->getStatisticForDisciplines($st1, $start, $end);

        $html = '';
        foreach ($disciplines as $key=>$discipline) {

            $i     = $key+1;
            $type  = SH::convertUS4($discipline['stus19']);
            $date  = SH::formatDate('Y-m-d H:i:s', 'Y-m-d', $discipline['stus6']);
            $mark  = in_array($discipline['stus8'], array(0,1,2,3,4,5)) ? $discipline['stus8'] : '+';
            $class = color($mark);

            $html .= <<<HTML
        <tr>
            <td>$i</td>
            <td>$discipline[d2]</td>
            <td>$discipline[stus20_]</td>
            <td>$type</td>
            <td class="{$class}">$mark</td>
            <td>$discipline[stus11]</td>
            <td>$discipline[stus3]</td>
            <td>$discipline[stus7]</td>
            <td>$date</td>
        </tr>
HTML;
    }
    echo $html;

    ?>

    </tbody>
</table>