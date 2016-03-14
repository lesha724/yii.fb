<?php
/* @var $this ProgressController
 * @var $model FilterForm
 */

$this->pageHeader=tt('Журнал');
$this->breadcrumbs=array(
    tt('Журнал'),
);
    Yii::app()->clientScript->registerPackage('noty');
    Yii::app()->clientScript->registerPackage('jquery.ui');

    Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/mobile/script/journal/journal.js', CClientScript::POS_HEAD);

    $error       = tt('Ошибка! Проверьте правильность вводимых данных или доступ для ввода!');
    $success     = tt('Cохранено!');
    $minMaxError = tt('Оценка за пределами допустимого интервала!');
    $access= tt('Ошибка! Нет доступа!');
    $st= tt('Ошибка! Студент заблокирован!');
    $error2= tt('Ошибка! Не найдены входящие данные!');
    $min=Elgzst::model()->getMin();
    $ps44 = PortalSettings::model()->findByPk(44)->ps2;
    $ps55 = PortalSettings::model()->findByPk(55)->ps2;

    Yii::app()->clientScript->registerScript('translations', <<<JS
        minBal = {$min}
        _error       = "{$error}" //errorType=0
        _success     = "{$success}"
        _minMaxError = "{$minMaxError}" //errorType=4
        _access = "{$access}" //errorType=3
        _st = "{$st}" //errorType=5
        _error2 = "{$error2}" //errorType=2
        ps44 = {$ps44}
        ps55 = {$ps55}
JS
    , CClientScript::POS_READY);
?>

<?php
$this->renderPartial('/filter_form/default/mobile/_accordion_select', array(
    'render' => '/filter_form/mobile/journal',
    'arr' => array('model' => $model)
));

$this->renderPartial('journal/_bottom', array('model' => $model,'read_only' => $read_only,'ps44'=>$ps44,'ps55'=>$ps55));
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