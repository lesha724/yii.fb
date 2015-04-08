<?php
/* @var $this ProgressController
 * @var $model FilterForm
 */
    $this->pageHeader=tt('Ведение модулей');
    $this->breadcrumbs=array(
        tt('Успеваемость'),
    );

    Yii::app()->clientScript->registerPackage('gritter');
	Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/progress/module.js', CClientScript::POS_HEAD);

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
	
	echo '<div class="alert alert-error">
		<h3>Внимание!</h3>
			Выберите нужный	 учебный год (2014) и нажмите "ОК"!
			</br>
			Кафедра->Поток->Дисциплина->Модуль->Группа->Ведомость
	</div>';

    $this->renderPartial('/filter_form/default/module', array(
        'model' => $model,
        'type'  => $type
    ));
	
    $this->renderPartial('module/_bottom', array(
        'model' => $model,
        'type' => $type,
    ));

