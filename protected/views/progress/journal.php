<?php
/* @var $this ProgressController
 * @var $model FilterForm
 */
    $this->pageHeader=tt('Электронный журнал');
    $this->breadcrumbs=array(
        tt('Успеваемость'),
    );

    Yii::app()->clientScript->registerPackage('gritter');
    Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/progress/journal.js', CClientScript::POS_HEAD);

    $error       = tt('Ошибка! Проверьте правильность вводимых данных!');
    $success     = tt('Cохранено!');
    $minMaxError = tt('Оценка за пределами допустимого интервала!');

    Yii::app()->clientScript->registerScript('translations', <<<JS
        tt.error       = "{$error}"
        tt.success     = "{$success}"
        tt.minMaxError = "{$minMaxError}"
JS
    , CClientScript::POS_READY);

?>

<?php
    $this->renderPartial('/filter_form/default/year_sem');

    $this->renderPartial('/filter_form/default/discipline_group', array(
        'model' => $model,
        'type'  => $type
    ));

    $this->renderPartial('journal/_bottom', array('model' => $model, 'type' => $type));
