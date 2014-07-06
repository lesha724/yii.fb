<?php
/**
 *
 * @var EntranceController $this
 */
Yii::app()->clientScript->registerPackage('chosen');
Yii::app()->clientScript->registerPackage('spin');
Yii::app()->clientScript->registerPackage('form-wizard');
Yii::app()->clientScript->registerPackage('datepicker');
Yii::app()->clientScript->registerPackage('autosize');


Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/entrance/registration.js', CClientScript::POS_HEAD);

$required  = tt('Поле обязательно для заполнения!');
$maxLength = tt('Пожалуйста, введите не больше чем {0} символов!');
$minLength = tt('Пожалуйста, введите не меньше чем {0} символов!');
$digits    = tt('Пожалуйста, введите только цифры!');

$getSpecialitiesUrl = Yii::app()->createUrl('/entrance/getSpecialities');

Yii::app()->clientScript->registerScript('translations', <<<JS
        tt.required  = "{$required}";
        tt.maxLength = "{$maxLength}";
        tt.minLength = "{$minLength}";
        tt.digits    = "{$digits}";

        getSpecialitiesUrl = "{$getSpecialitiesUrl}"
JS
    , CClientScript::POS_END);

$this->pageHeader=tt('Регистрация абитуриента');
$this->breadcrumbs=array(
    tt('Регистрация абитуриента'),
);

echo <<<HTML
    <span id="spinner1"></span>
HTML;

?>

<?php
    $this->renderPartial('registration/_bottom', array(
        'model' => $model,
    ));
?>


