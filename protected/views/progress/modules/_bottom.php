<?php
/* @var $this DefaultController
 * @var $model FilterForm
 */


if (! empty($model->group)):

    $ps16 = PortalSettings::model()->findByPk(16)->ps2;

    if (empty($moduleInfo)) {
        $warning = tt('Внимание');
        $error   = tt('Для ведомости не задано количество модулей');
        echo <<<HTML
                <div class="alert alert-warning">
                    <strong>{$warning}!</strong>
                    {$error}!
                    <br>
                </div>
HTML;
        return;
    }
    $vvmp1 = $moduleInfo['vvmp1'];

    $students = St::model()->getStudentsForJournal($model->group, $moduleInfo['uo1']);

    echo <<<HTML
<div class="journal-bottom">
HTML;

    $this->renderPartial('modules/_table_1', array(
        'students' => $students
    ));

    $this->renderPartial('modules/_table_2', array(
        'students' => $students,
        'moduleInfo' => $moduleInfo,
        'ps16' => $ps16
    ));

    $this->renderPartial('modules/_table_3', array(
        'students' => $students,
        'moduleInfo' => $moduleInfo,
        'vvmp1' => $vvmp1,
    ));

    echo <<<HTML
</div>
HTML;

    Yii::app()->clientScript->registerScript('module-vars', <<<JS
        vvmp1 = {$vvmp1};
        ps16 = {$ps16};
JS
        , CClientScript::POS_READY);

endif;