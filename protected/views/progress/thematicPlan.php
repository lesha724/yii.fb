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
    Yii::app()->clientScript->registerPackage('jquery.ui');
    Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/progress/thematicPlan.js', CClientScript::POS_HEAD);

    $confirmDeleteMsg = tt('Вы уверены, что хотите удалить тему?');

    Yii::app()->clientScript->registerScript('themes-messages', <<<JS
        tt.confirmDeleteMsg  = '{$confirmDeleteMsg}';
JS
    , CClientScript::POS_READY);


   $this->renderPartial('/filter_form/progress/thematicPlan', array(
       'model' => $model,
   ));

echo <<<HTML
    <span id="spinner1"></span>
HTML;


if (! empty($model->semester))
    $this->renderPartial('thematicPlan/_bottom', array(
        'model' => $model,
    ));