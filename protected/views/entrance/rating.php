<?php
/**
 *
 * @var EntranceController $this
 */
Yii::app()->clientScript->registerPackage('chosen');
Yii::app()->clientScript->registerPackage('spin');
Yii::app()->clientScript->registerPackage('jqplot');

Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/entrance/rating.js', CClientScript::POS_HEAD);


$this->pageHeader=tt('Рейтинговый список');
$this->breadcrumbs=array(
    tt('Рейтинговый список'),
);

?>

<?php
    $this->renderPartial('/filter_form/entrance/rating', array(
        'model' => $model,
    ));

echo <<<HTML
    <span id="spinner1"></span>
HTML;


if (! empty($model->course))
    $this->renderPartial('rating/_bottom', array(
        'model' => $model,
        'list_1' => $list_1,
        'list_3' => $list_3,
        'list_4' => $list_4,
        'list_5' => $list_5,
    ));

?>


