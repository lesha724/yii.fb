<?php

class ProgressController extends Controller
{
    public function filters() {

        return array(
            'accessControl',
        );
    }

    public function accessRules() {

        return array(
            array('allow',
                'actions' => array(
                    'journal',
                    'getGroups',
                    'insertMark'
                ),
                'expression' => 'Yii::app()->user->isAdmin || Yii::app()->user->isTch',
            ),
            array('deny',
                'users' => array('*'),
            ),
        );
    }

    public function actionJournal()
    {
        $type = 0; // own disciplines

        $grants = Yii::app()->user->dbModel->grants;
        if (! empty($grants))
            $type = $grants->getGrantsFor(Grants::EL_JOURNAL);


        $model=new JournalForm;

        if (isset($_POST['JournalForm']))
            $model->attributes=$_POST['JournalForm'];


        if (! empty($model->group))
            $this->fillJournalFor($model);

        $this->render('journal', array(
            'model' => $model,
            'type' => $type,
        ));
    }

    public function actionGetGroups()
    {
        if (! Yii::app()->request->isAjaxRequest)
            throw new CHttpException(404, 'Invalid request. Please do not repeat this request again.');

        $type = Yii::app()->request->getParam('type', 0);
        $discipline = Yii::app()->request->getParam('discipline', 0);

        $groups = CHtml::listData(Gr::model()->getGroupsFor($discipline, $type), 'gr1', 'name');

        echo CHtml::dropDownList('JournalForm[group]', '',$groups, array('id'=>'JournalForm_group', 'class'=>'chosen-select', 'autocomplete' => 'off', 'empty' => '&nbsp;'));
    }

    private function fillJournalFor($model)
    {
        $gr1  = $model->group;
        $p1   = Yii::app()->user->dbModel->p1;
        $d1   = $model->discipline;
        $date = date('Y-m-d');
        $year = Yii::app()->session['year'];
        $sem  = Yii::app()->session['sem'];
        Steg::model()->fillDataForGroup($gr1, $p1, $d1, $date, $year, $sem);
    }

    public function actionInsertMark()
    {
        if (! Yii::app()->request->isAjaxRequest)
            throw new CHttpException(404, 'Invalid request. Please do not repeat this request again.');

        $steg1 = Yii::app()->request->getParam('st1', null);
        $steg2 = Yii::app()->request->getParam('nr1', null);
        $steg3 = Yii::app()->request->getParam('date', null);
        $field = Yii::app()->request->getParam('field', null);
        $value = Yii::app()->request->getParam('value', null);

        if ($field == 'steg5')
            $attr = array('steg5' => $value);
        elseif ($field == 'steg6')
            $attr = array('steg6' => $value);
        elseif ($field == 'steg9')
            $attr = array('steg9' => $value);

        $criteria = new CDbCriteria();
        $criteria->compare('steg1', $steg1);
        $criteria->compare('steg2', $steg2);
        $criteria->compare('steg3', $steg3);

        $model = Steg::model()->find($criteria);
        if (empty($model))
            $error = true;
        else
            $error = !$model->saveAttributes($attr);

        Yii::app()->end(CJSON::encode(array('error' => $error)));
    }
}