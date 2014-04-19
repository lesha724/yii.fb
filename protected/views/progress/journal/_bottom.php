<?php
/* @var $this DefaultController
 * @var $model FilterForm
 */


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

    $nr1 = array();
    foreach ($dates as $date) {
        $nr1[] = $date['nr1'];
    }
    $nr1 = array_values(array_unique($nr1));

    $ps9  = PortalSettings::model()->findByPk(9)->ps2;
    $ps20 = PortalSettings::model()->findByPk(20)->ps2;// use sub modules

    $students = St::model()->getStudentsForJournal($model->group, $uo1);

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
        'nr1'   => $nr1,
        'ps9'   => $ps9,
        'ps20'  => $ps20,
        'pbal'  => $pbal,
    ));

    $this->renderPartial('journal/_table_3', array(
        'students' => $students,
        'dates'    => $dates,
        'nr1'      => $nr1,
        'ps9'      => $ps9,
        'ps20'     => $ps20,
    ));
echo <<<HTML
</div>
HTML;

    $journalType = PortalSettings::model()->findByPk(8)->ps2;
    if ($journalType == 1)
        $this->renderPartial('journal/_modules', array(
            'students' => $students,
            'dates' => $dates,
            'nr1' => $nr1,
        ));


    $insertMarkUrl = Yii::app()->createAbsoluteUrl('/progress/insertMark');
    $arrayNR1  = CJSON::encode($nr1);
    $arrayPbal = CJSON::encode($pbal);

    Yii::app()->clientScript->registerScript('journal-vars', <<<JS
        nr1  = {$arrayNR1};
        ps9  = {$ps9};
        ps20 = {$ps20};
        insertMarkUrl = "{$insertMarkUrl}";
        pbal = {$arrayPbal};
JS
    , CClientScript::POS_HEAD);


endif;