<?php
/**
 *
 * @var OtherController $this
 * @var CActiveForm $form
 */

$this->pageHeader=tt('Запись на гос. экзамены');
$this->breadcrumbs=array(
    tt('Запись на гос. экзамены'),
);


Yii::app()->clientScript->registerPackage('chosen');
Yii::app()->clientScript->registerPackage('spin');
Yii::app()->clientScript->registerPackage('dataTables');

Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/other/gostem.js', CClientScript::POS_HEAD);


$confirmDeleteMsg = tt('Вы уверены, что хотите удалить подписку на экзамен?');
Yii::app()->clientScript->registerScript('themes-messages', <<<JS
    tt.confirmDeleteMsg  = '{$confirmDeleteMsg}';
JS
    , CClientScript::POS_READY);


$this->renderPartial('/filter_form/other/gostem', array(
    'model' => $model,
));

echo <<<HTML
    <span id="spinner1"></span>
HTML;



if (! empty($model->gostem1)) {

    $button = <<<HTML
<button class="btn btn-large btn-success no-border" id="confirm-subscription">
    <i class="icon-ok bigger-150"></i>
    %s
</button>
HTML;
    $error  = <<<HTML
<div class="alert alert-error">
    <button data-dismiss="alert" class="close" type="button">
        <i class="icon-remove"></i>
    </button>
    %s
    <br>
</div>
HTML;

    $canSubscribe = Nrst::model()->studentIsAlreadySubscribed($model->d1, $model->chair);

    if (! $canSubscribe)
        echo sprintf($button, tt('Записаться на гос. экзамен'));
    else
        echo sprintf($error, tt('Вы уже записаны на этот экзамен!'));

}

$this->renderPartial('gostem/_bottom', array(
    'model' => $model,
));
?>

