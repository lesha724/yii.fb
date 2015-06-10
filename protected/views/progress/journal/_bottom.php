<?php
/* @var $this ProgressController
 * @var $model FilterForm
 */


if (! empty($model->group)):

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

    $students = St::model()->getStudentsForJournal($gr1, $us1);
    $pbal     = Pbal::model()->getAllInArray();

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
        'ps20'  => $ps20,
        'pbal'  => $pbal,
    ));

    $this->renderPartial('journal/_table_3', array(
        'students' => $students,
        'dates'    => $dates,
        'us1'=>$us1,
        'gr1'=>$gr1,
        //'nr1'      => $nr1,
        'ps9'      => $ps9,
        'ps20'     => $ps20,
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