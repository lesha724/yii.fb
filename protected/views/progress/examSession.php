<?php
/* @var $this ProgressController
 * @var $model FilterForm
 */
    $this->pageHeader=tt('Экзаменационная сессия');
    $this->breadcrumbs=array(
        tt('Успеваемость'),
    );

    Yii::app()->clientScript->registerPackage('jquery.ui');
    Yii::app()->clientScript->registerPackage('datepicker');
    Yii::app()->clientScript->registerPackage('gritter');
    Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/progress/examSession.js', CClientScript::POS_HEAD);

    $error       = tt('Ошибка! Проверьте правильность вводимых данных!');
    $success     = tt('Cохранено!');
    $minMaxError1 = tt('Оценка за пределами допустимого интервала!');
    $minMaxError2 = tt('Дрпустимые оценки: 3,4,5');

    Yii::app()->clientScript->registerScript('translations', <<<JS
        tt.error        = "{$error}"
        tt.success      = "{$success}"
        tt.minMaxError1 = "{$minMaxError1}"
        tt.minMaxError2 = "{$minMaxError2}"
JS
    , CClientScript::POS_READY);

?>

<?php
    $this->renderPartial('/filter_form/default/year_sem');

    $this->renderPartial('/filter_form/progress/examSession', array(
        'model' => $model,
        'type'  => $type
    ));

    $this->renderPartial('examSession/_bottom', array('model' => $model, 'type' => $type));
