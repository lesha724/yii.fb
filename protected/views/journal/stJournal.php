<?php
/* @var $this ProgressController
 * @var $model FilterForm
 */
    $this->pageHeader=tt('Электронный журнал');
    $this->breadcrumbs=array(
        tt('Электронный журнал'),
    );

    Yii::app()->clientScript->registerPackage('gritter');
    Yii::app()->clientScript->registerPackage('jquery.ui');
    Yii::app()->clientScript->registerPackage('datepicker');
    Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/journal/journal.js', CClientScript::POS_HEAD);

    $error       = tt('Ошибка! Проверьте правильность вводимых данных или доступ для ввода!');
    $success     = tt('Cохранено!');
    $minMaxError = tt('Оценка за пределами допустимого интервала!');
    $access= tt('Ошибка! Нет доступа!');
    $st= tt('Ошибка! Студент заблокирован!');
    $error2= tt('Ошибка! Не найдены входящие данные!');
    $min=Elgzst::model()->getMin();
    $ps44 = PortalSettings::model()->getSettingFor(44);
    $ps55 = PortalSettings::model()->getSettingFor(55);
    $ps84 = PortalSettings::model()->getSettingFor(84);
    $ps88 = PortalSettings::model()->getSettingFor(88);
    $timeAccess = tt('Ошибка! Доступ на редактирование закрыт!');
    $notFoundVmpv = tt('Ошибка! Ведомость не найдена или закрыта!');
    $errorEnableCount = tt('Ошибка! Есть отработки!');

//errorType=0 error
//errorType=4 minMaxError
//errorType=3 access
//errorType=5 st
//errorType=2 error2
//errorType=6 timeAccess
//errorType=9 Not Found vmpv
    Yii::app()->clientScript->registerScript('translations', <<<JS
        minBal = {$min}
        tt.error       = "{$error}";
        tt.success     = "{$success}";
        tt.minMaxError = "{$minMaxError}";
        tt.timeAccess = "{$timeAccess}";
        tt.access = "{$access}";
        tt.st = "{$st}";
        tt.error2 = "{$error2}";
        tt.notFoundVmpv = "{$notFoundVmpv}";
        ps44 = {$ps44};
        ps55 = {$ps55};
        ps84 = {$ps84};
        ps88 = {$ps88};
        tt.errorEnableCount = "{$errorEnableCount}";
        isStd = true;
JS
    , CClientScript::POS_READY);

?>

<?php
    $this->renderPartial('/filter_form/default/year_sem');

    $this->renderPartial('/filter_form/default/discipline_sst', array(
        'model' => $model,
    ));
    
if(!empty($model->discipline)) {

    /*костыль для адаптации к journal/_bottom*/
    list($uo1,$d1) = explode("/", $model->discipline);
    $model->discipline=$d1;
    $model->group = $uo1.'/'.$model->group;

    $this->renderPartial('journal/_bottom', array('isStd'=>true, 'model' => $model, 'read_only' => false, 'ps44' => $ps44, 'ps55' => $ps55, 'ps88' => $ps88));
}