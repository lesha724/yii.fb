
<form class="form-inline" method="POST">
    <?php
        $previousYear = date('Y', strtotime('-1 year'));
        $currentYear  = date('Y');
        $nextYear     = date('Y', strtotime('+1 year'));
		
        $options = array(
            $previousYear => $previousYear,
            $currentYear  => $currentYear,
            $nextYear     => $nextYear,
        );
		
        echo CHtml::dropDownList('year', Yii::app()->session['year'], $options, array('class'=>'input-small'));
	
		//echo CHtml::dropDownList('year', '2014', $options, array('class'=>'input-small'));
        $options = array(
            tt('Осенний'),
            tt('Весенний')
        );
        echo CHtml::dropDownList('sem', Yii::app()->session['sem'], $options, array('class'=>'input-medium'));
    ?>
    <button class="btn btn-info btn-small" type="submit">
        <i class="icon-ok bigger-110"></i>
        <?=tt('Ок')?>
    </button>
</form>