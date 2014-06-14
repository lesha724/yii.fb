<?php
/**
 *
 * @var EntranceController $this
 */
Yii::app()->clientScript->registerPackage('chosen');
Yii::app()->clientScript->registerPackage('spin');
Yii::app()->clientScript->registerPackage('jqplot');

Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/entrance/documentReception.js', CClientScript::POS_HEAD);


$this->pageHeader=tt('Ход приема документов');
$this->breadcrumbs=array(
    tt('Ход приема документов'),
);

?>

<?php
    $this->renderPartial('/filter_form/documentReception', array(
        'model' => $model,
    ));

echo <<<HTML
    <span id="spinner1"></span>
HTML;


if (! empty($model->course))
    $this->renderPartial('documentReception/_bottom', array(
        'model' => $model,
    ));
?>


