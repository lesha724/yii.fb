<?php
/* @var $this ProgressController
 * @var $model FilterForm
 */


if (! empty($model->group)):

    $this->widget('bootstrap.widgets.TbButton', array(
		'buttonType'=>'button',
		'type'=>'primary',
                
		'icon'=>'print',
		'label'=>tt('Печать'),
		'htmlOptions'=>array(
                    'class'=>'btn-small',
                    'data-url'=>Yii::app()->createUrl('/progress/journalExcel'),
                    'id'=>'journal-print',
		)
	));
    $this->renderPartial('/filter_form/default/_refresh_filter_form_button');

    $arr = explode("/", $model->group);
    $us1=$arr[0];
    $gr1=$arr[1];
    $dates = R::model()->getDatesForJournal(
            $us1,
            $gr1
    );
    
    /*$us1_arr = array();
    foreach ($dates as $date) {
        $us1_arr[] = $date['us1'];
    }*/
    $ps9  = PortalSettings::model()->findByPk(9)->ps2;
    $ps20 = PortalSettings::model()->findByPk(20)->ps2;// use sub modules
    $ps33=PortalSettings::model()->findByPk(33)->ps2;

    $students = St::model()->getStudentsForJournal($gr1, $us1);
    $pbal     = Pbal::model()->getAllInArray();
    $us=Us::model()->findByPk($us1);

echo <<<HTML
<div class="journal-bottom">
HTML;

    $this->renderPartial('journal/_table_1', array(
        'students' => $students
    ));

    $this->renderPartial('journal/_table_2', array(
        'students' => $students,
        'dates' => $dates,
        'us1'=>$us1,
        //'us1_arr'=>$us1_arr,
        'gr1'=>$gr1,
        'ps9'   => $ps9,
        'us'=>$us,
        'ps20'  => $ps20,
        'ps33'  => $ps33,
        'pbal'  => $pbal,
    ));
    if($us->us4!=1)
    $this->renderPartial('journal/_table_3', array(
        'students' => $students,
        'dates'    => $dates,
        'us1'=>$us1,
        'gr1'=>$gr1,
        'us'=>$us,
        //'nr1'      => $nr1,
        'ps9'      => $ps9,
        'ps20'     => $ps20,
        'ps33'  => $ps33,
    ));
echo <<<HTML
</div>
HTML;

    $journalType = PortalSettings::model()->findByPk(8)->ps2;
    /*if (empty($nr1))
        Yii::app()->user->setFlash('error', "Empty nr1 array!");
    elseif ($journalType == 1)
        $this->renderPartial('journal/_modules', array(
            'students' => $students,
            'dates' => $dates,
            'nr1' => $nr1,
        ));*/


   $insertMarkUrl = Yii::app()->createAbsoluteUrl('/progress/insertMark');
    $arrayPbal = CJSON::encode($pbal);

    Yii::app()->clientScript->registerScript('journal-vars', <<<JS
        ps9  = {$ps9};
        ps20 = {$ps20};
        insertMarkUrl = "{$insertMarkUrl}";
        pbal = {$arrayPbal};
JS
    , CClientScript::POS_HEAD);
endif;
?>
<div id="dialog-confirm" class="hide" title="Empty the recycle bin?">
    <div class="alert alert-info bigger-110">
        <?=tt('По данному пропуску есть отработки. Все отработки будут удалены!')?>
    </div>

    <div class="space-6"></div>

    <p class="bigger-110 bolder center grey">
        <i class="icon-hand-right blue bigger-120"></i>
        <?=tt('Вы уверены?')?>
    </p>
</div><!-- #dialog-confirm -->