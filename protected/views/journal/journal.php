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
    Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/journal/journal.js', CClientScript::POS_HEAD);

    $error       = tt('Ошибка! Проверьте правильность вводимых данных или доступ для ввода!');
    $success     = tt('Cохранено!');
    $minMaxError = tt('Оценка за пределами допустимого интервала!');
    $access= tt('Ошибка! Нет доступа!');
    $st= tt('Ошибка! Студент заблокирован!');
    $error2= tt('Ошибка! Не найдены входящие данные!');
    $min=Elgzst::model()->getMin();

    Yii::app()->clientScript->registerScript('translations', <<<JS
        min = {$min}
        tt.error       = "{$error}" //errorType=0
        tt.success     = "{$success}"
        tt.minMaxError = "{$minMaxError}" //errorType=4
        tt.access = "{$access}" //errorType=3
        tt.st = "{$st}" //errorType=5
        tt.error2 = "{$error2}" //errorType=2
JS
    , CClientScript::POS_READY);

?>

<?php
    $this->renderPartial('/filter_form/default/year_sem');

    $this->renderPartial('/filter_form/default/discipline_group_type', array(
        'model' => $model,
    ));
    
    
   $this->renderPartial('journal/_bottom', array('model' => $model,'read_only' => $read_only));
