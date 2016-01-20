<?php
/**
 *
 * @var ProgressController $this
 * @var $model FilterForm
 */

    $this->pageHeader=tt('Тематический план');
    $this->breadcrumbs=array(
        tt('Электронный журнал'),
    );

    //Yii::app()->clientScript->registerPackage('dataTables');
    Yii::app()->clientScript->registerPackage('gritter');
    Yii::app()->clientScript->registerPackage('jquery.ui');
    Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/journal/thematicPlan.js', CClientScript::POS_HEAD);

    $confirmDeleteMsg = tt('Вы уверены, что хотите удалить тему?');
    $error       = tt('Ошибка! Проверьте правильность вводимых данных!');
    $success     = tt('Cохранено!');
    $access       = tt('Ошибка! Нет доступа на запись!');
    $errorUs6      = tt('Ошибка! Количество часов привышено!');
    $emptyPlan      = tt('Ошибка! Копируемый план пуст!');

    $maxL = Ustem::USTEM5_LENGHT;
    Yii::app()->clientScript->registerScript('themes-messages', <<<JS
        tt.confirmDeleteMsg  = '{$confirmDeleteMsg}';
        tt.error       = "{$error}"
        tt.success     = "{$success}"
        tt.errorAccess = "{$access}"
        tt.errorUs6 = "{$errorUs6}"
        tt.emptyPlan = "{$emptyPlan}"

        ustem5Lenght = {$maxL}
JS
    , CClientScript::POS_READY);


    $this->renderPartial('/filter_form/default/year_sem');

    $this->renderPartial('/filter_form/default/discipline_group_tplan', array(
        'model' => $model,
    ));

echo <<<HTML
    <span id="spinner1"></span>
HTML;

    $this->renderPartial('thematicPlan/_bottom', array(
        'model' => $model,
        'read_only'=>$read_only
    ));