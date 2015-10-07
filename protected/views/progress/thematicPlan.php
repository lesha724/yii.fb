<?php
/**
 *
 * @var ProgressController $this
 * @var $model FilterForm
 */

    $this->pageHeader=tt('Тематический план');
    $this->breadcrumbs=array(
        tt('Успеваемость'),
    );

    Yii::app()->clientScript->registerPackage('dataTables');
    Yii::app()->clientScript->registerPackage('gritter');
    Yii::app()->clientScript->registerPackage('jquery.ui');
    Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/progress/thematicPlan.js', CClientScript::POS_HEAD);

    $confirmDeleteMsg = tt('Вы уверены, что хотите удалить тему?');
    $error       = tt('Ошибка! Проверьте правильность вводимых данных!');
    $success     = tt('Cохранено!');

    Yii::app()->clientScript->registerScript('themes-messages', <<<JS
        tt.confirmDeleteMsg  = '{$confirmDeleteMsg}';
        tt.error       = "{$error}"
        tt.success     = "{$success}"
JS
    , CClientScript::POS_READY);


    $this->renderPartial('/filter_form/default/year_sem');

    $this->renderPartial('/filter_form/default/discipline_group_tplan', array(
        'model' => $model,
    ));

echo <<<HTML
    <span id="spinner1"></span>
HTML;


//if (! empty($model->group))
    $this->renderPartial('thematicPlan/_bottom', array(
        'model' => $model,
    ));