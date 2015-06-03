<?php
/**
 * @var St $student
 * @var Sdp $model
 * @var CActiveForm $form
 * @var Psto[] $comments
 */

$this->breadcrumbs=array(
    tt('Трудоустройство') => '/other/employment',
    tt('Информация о студенте'),
);

Yii::app()->clientScript->registerPackage('dataTables');
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/other/_st_info.js', CClientScript::POS_HEAD);

    $params = array(
        'model'   => $model,
        'student' => $student,
        'isEditable' => $isEditable,
    );

    $this->renderPartial('//other/employment/_st_info_form', $params);

    if ($model->sdp32 == 1)
        $this->renderPartial('//other/employment/_st_info_marks', $params);


    if ($model->sdp33 == 1)
        $this->renderPartial('//other/employment/_st_info_comments', $params + array('comments' => $comments));
