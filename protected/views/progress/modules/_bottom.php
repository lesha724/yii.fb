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

    $isClosed = !empty($moduleInfo['data_close_ved']);

    echo <<<HTML
<div class="journal-bottom" style="float:left">
HTML;

    if ($isClosed) {
        $closed = tt('Ведомость была закрыта ').$moduleInfo['data_close_ved'];
        echo <<<HTMl
            <div class="alert alert-error">
                <button data-dismiss="alert" class="close" type="button">
                    <i class="icon-remove"></i>
                </button>
                <strong>
                    <i class="icon-remove"></i>
                </strong>
                {$closed}
                <br>
            </div>
HTMl;
    }

    $this->renderPartial('modules/_table_1', array(
        'students' => $students
    ));

    $this->renderPartial('modules/_table_2', array(
        'students'   => $students,
        'moduleInfo' => $moduleInfo,
        'ps16'       => $ps16,
        'isClosed'   => $isClosed
    ));

    $this->renderPartial('modules/_table_3', array(
        'students'   => $students,
        'moduleInfo' => $moduleInfo,
        'vvmp1'      => $vvmp1,
        'isClosed'   => $isClosed
    ));

    echo <<<HTML
</div>
HTML;


    if (! $isClosed) {
        $closeText = tt('Закрыть ведомость');
        $url = Yii::app()->createUrl('progress/closeModule');
        echo <<<HTML
            <button class="btn btn-large btn-danger" id="close-module" data-url="{$url}">
                <i class="icon-lock bigger-160"></i>
                {$closeText}
            </button>
HTML;
    }
    Yii::app()->clientScript->registerScript('module-vars', <<<JS
        vvmp1 = {$vvmp1};
        ps16  = {$ps16};
JS
        , CClientScript::POS_READY);

endif;