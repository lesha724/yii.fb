<?php
/**
 *
 * @var EntranceController $this
 */
Yii::app()->clientScript->registerPackage('jqplot');

Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/entrance/documentReception.js', CClientScript::POS_HEAD);


$this->pageHeader=tt('Ход приема документов');
$this->breadcrumbs=array(
    tt('Ход приема документов'),
);

?>

<?php
    $this->renderPartial('/filter_form/entrance/documentReception', array(
        'model' => $model,
    ));

echo <<<HTML
    <span id="spinner1"></span>
HTML;

$showBottom = SH::is(U_BSAA)
                ? $model->sel_1 != '' && $model->sel_2 != ''
                : !empty($model->course);

if ($showBottom)
    $this->renderPartial('documentReception/_bottom', array(
        'model' => $model,
    ));
?>


