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
                    'insertStegMark',
                    'insertDsejMark',
                    'insertMmbjMark',
                    'insertMejModule',
                    'deleteMejModule'
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


        $model = new JournalForm;
        if (isset($_REQUEST['JournalForm']))
            $model->attributes=$_REQUEST['JournalForm'];


        if (! empty($model->group)) {
            $this->fillJournalFor($model);

        }

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

    public function actionInsertStegMark()
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

    public function actionInsertDsejMark()
    {
        if (! Yii::app()->request->isAjaxRequest)
            throw new CHttpException(404, 'Invalid request. Please do not repeat this request again.');

        $dsej2 = Yii::app()->request->getParam('st1', null);
        $dsej3 = Yii::app()->request->getParam('nr1', null);
        $field = Yii::app()->request->getParam('field', null);
        $value = Yii::app()->request->getParam('value', null);

        if ($field == 'dsej4')
            $attr = array('dsej4' => $value);
        elseif ($field == 'dsej5')
            $attr = array('dsej5' => $value);
        elseif ($field == 'dsej6')
            $attr = array('dsej6' => $value);
        elseif ($field == 'dsej7')
            $attr = array('dsej7' => $value);

        $criteria = new CDbCriteria();
        $criteria->compare('dsej2', $dsej2);
        $criteria->compare('dsej3', $dsej3);

        $model = Dsej::model()->find($criteria);
        if (empty($model))
            $error = true;
        else
            $error = !$model->saveAttributes($attr);

        Yii::app()->end(CJSON::encode(array('error' => $error)));
    }

    public function actionInsertMmbjMark()
    {
        if (! Yii::app()->request->isAjaxRequest)
            throw new CHttpException(404, 'Invalid request. Please do not repeat this request again.');

        $mmbj1 = Yii::app()->request->getParam('mmbj1', null);
        $field = Yii::app()->request->getParam('field', null);
        $value = Yii::app()->request->getParam('value', null);

        if ($field == 'mmbj4')
            $attr = array('mmbj4' => $value);
        elseif ($field == 'mmbj5')
            $attr = array('mmbj5' => $value);

        $criteria = new CDbCriteria();
        $criteria->compare('mmbj1', $mmbj1);

        $model = Mmbj::model()->find($criteria);
        if (empty($model))
            $error = true;
        else
            $error = !$model->saveAttributes($attr);

        Yii::app()->end(CJSON::encode(array('error' => $error)));
    }

    public function actionInsertMejModule()
    {
        if (! Yii::app()->request->isAjaxRequest)
            throw new CHttpException(404, 'Invalid request. Please do not repeat this request again.');

        $mej3  = Yii::app()->request->getParam('mej3', null);
        $mej4  = Yii::app()->request->getParam('mej4', null);
        $mej5  = Yii::app()->request->getParam('mej5', null);
        $vvmp1 = Yii::app()->request->getParam('vvmp1', null);

        $model = new Mej();
        $model->mej1 = new CDbExpression('GEN_ID(GEN_MEJ, 1)');
        $model->mej3 = $mej3;
        $model->mej4 = $mej4;
        $model->mej5 = $mej5;

        $error = !$model->save();

        if (! $error)
            Vmp::model()->recalculateModulesFor($vvmp1, $mej3);



        Yii::app()->end(CJSON::encode(array('error' => $error, 'errors' => $model->getErrors())));
    }

    public function actionDeleteMejModule()
    {
        if (! Yii::app()->request->isAjaxRequest)
            throw new CHttpException(404, 'Invalid request. Please do not repeat this request again.');

        $mej1  = Yii::app()->request->getParam('mej1', null);
        $nr1   = Yii::app()->request->getParam('nr1', null);
        $vvmp1 = Yii::app()->request->getParam('vvmp1', null);

        $deleted = Mej::model()->deleteByPk($mej1);

        if ($deleted)
            Vmp::model()->recalculateModulesFor($vvmp1, $nr1);
    }

}