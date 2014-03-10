<?php
/* @var $this ProgressController
 * @var $model JournalForm
 */
    $this->pageHeader=tt('Электронный журнал');
    $this->breadcrumbs=array(
        tt('Успеваемость'),
    );


    Yii::app()->clientScript->registerPackage('chosen');
    Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/progress/journal.js', CClientScript::POS_HEAD);

    $getGroupUrl = Yii::app()->createAbsoluteUrl('/progress/getGroups');
    Yii::app()->clientScript->registerScript('getGroupsUrl', <<<JS
        getGroupsUrl = "{$getGroupUrl}"
JS
    ,CClientScript::POS_READY);
?>

<?php
    $this->renderPartial('/widget/year_sem');



    $form=$this->beginWidget('CActiveForm', array(
        'id'=>'journal-form',
    ));

        $disciplines = CHtml::listData(D::model()->getDisciplines($type), 'd1', 'd2');
        echo $form->label($model,'discipline');
        echo $form->dropDownList($model, 'discipline', $disciplines, array('class'=>'chosen-select', 'autocomplete' => 'off', 'empty' => tt('&nbsp;')));

        $groups = CHtml::listData(Gr::model()->getGroupsFor($model->discipline, $type), 'gr1', 'name');
        echo $form->label($model, 'group');
        echo $form->dropDownList($model, 'group', $groups, array('class'=>'chosen-select', 'autocomplete' => 'off', 'empty' => tt('&nbsp;')));

        echo CHtml::hiddenField('type', $type);

    $this->endWidget();

    $this->renderPartial('journal/_students', array('model' => $model, 'type' => $type));


?>

