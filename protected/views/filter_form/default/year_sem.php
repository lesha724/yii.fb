
<form class="form-inline" id="filter-year-sem-form" method="POST">
    <?php
        $previousYear5 = date('Y', strtotime('-6 year'));
        $previousYear4 = date('Y', strtotime('-5 year'));
        $previousYear3 = date('Y', strtotime('-4 year'));
        $previousYear2 = date('Y', strtotime('-3 year'));
        $previousYear1 = date('Y', strtotime('-2 year'));
        $previousYear = date('Y', strtotime('-1 year'));
        $currentYear  = date('Y');
        $nextYear     = date('Y', strtotime('+1 year'));
		$nextYear1     = date('Y', strtotime('+2 year'));
		
        $options = array(
            $previousYear5 => $previousYear5.'/'.$previousYear4,
            $previousYear4 => $previousYear4.'/'.$previousYear3,
            $previousYear3 => $previousYear3.'/'.$previousYear2,
            $previousYear2 => $previousYear2.'/'.$previousYear1,
            $previousYear1 => $previousYear1.'/'.$previousYear,
            $previousYear => $previousYear.'/'.$currentYear,
            $currentYear  => $currentYear.'/'.$nextYear,
            $nextYear     => $nextYear.'/'.$nextYear1,
        );
		
        echo CHtml::dropDownList('year', Yii::app()->session['year'], $options, array('class'=>'input-small','style'=>'width:130px'));

        $options = array(
            tt('Осенний'),
            tt('Весенний')
        );
        echo CHtml::dropDownList('sem', Yii::app()->session['sem'], $options, array('class'=>'input-medium'));
    ?>
</form>