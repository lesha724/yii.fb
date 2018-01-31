<?php
$options =  array('autocomplete' => 'off'/*, 'empty' => '&nbsp;'*/);

$groups = CHtml::listData(Gr::model()->getGroupsForCopyThematicPlan($discipline, $year, $sem), 'us1', 'name');

$previous1Year = date('Y', strtotime('-2 year'));
$previousYear = date('Y', strtotime('-1 year'));
$currentYear  = date('Y');
$nextYear     = date('Y', strtotime('+1 year'));
$nextYear1     = date('Y', strtotime('+2 year'));

$year_arr = array(
    $previous1Year => $previous1Year.'/'.$previousYear,
    $previousYear => $previousYear.'/'.$currentYear,
    $currentYear  => $currentYear.'/'.$nextYear,
    $nextYear     => $nextYear.'/'.$nextYear1,
);

$sem_arr = array(
    tt('Осенний'),
    tt('Весенний')
);
?>
<div class="control-group">
    <label class="control-label" for="year-rows"><?=tt('Уч. год')?></label>
    <div class="controls">
        <?=CHtml::dropDownList('year-rows', $year,$year_arr,$options)?>
    </div>
</div>
<div class="control-group">
    <label class="control-label" for="sem-rows"><?=tt('Семестр')?></label>
    <div class="controls">
        <?=CHtml::dropDownList('sem-rows',$sem,$sem_arr,$options)?>
    </div>
</div>
<div class="control-group group-rows-control">
    <label class="control-label" for="group-rows"><?=tt('Копировать тем. план потока')?></label>
    <div class="controls">
        <?=CHtml::dropDownList('group-rows',0,$groups, array('autocomplete' => 'off','class'=>'autocomplete'))?>
    </div>
</div>
