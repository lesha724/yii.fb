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
                    'deleteMejModule',
                    'modules',
                    'updateVvmp',
                    'insertVmpMark',
                    'updateStus',
                    'closeModule',
                    'renderExtendedModule',
                    'thematicPlan',
                    'renderNrTheme',
                    'deleteNrTheme',
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


        $model = new FilterForm;
        $model->scenario = 'journal';
        if (isset($_REQUEST['FilterForm']))
            $model->attributes=$_REQUEST['FilterForm'];


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

        echo CHtml::dropDownList('FilterForm[group]', '',$groups, array('id'=>'FilterForm_group', 'class'=>'chosen-select', 'autocomplete' => 'off', 'empty' => '&nbsp;'));
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

    public function actionModules()
    {
        $type = 0; // own modules

        $grants = Yii::app()->user->dbModel->grants;
        if (! empty($grants))
            $type = $grants->getGrantsFor(Grants::MODULES);

        $model = new FilterForm;
        $model->scenario = 'modules';
        if (isset($_REQUEST['FilterForm']))
            $model->attributes=$_REQUEST['FilterForm'];


        $moduleInfo = null;
        if (! empty($model->group)) {
            $moduleInfo = $this->fillModulesFor($model);
        }

        $this->render('modules', array(
            'model'      => $model,
            'type'       => $type,
            'moduleInfo' => $moduleInfo,
        ));
    }

    private function fillModulesFor($model)
    {
        $gr1  = $model->group;
        $d1   = $model->discipline;
        $year = Yii::app()->session['year'];
        $sem  = Yii::app()->session['sem'];
        $res = Vvmp::model()->fillDataForGroup($gr1, $d1, $year, $sem);
        return $res;
    }

    public function actionUpdateVvmp()
    {
        if (! Yii::app()->request->isAjaxRequest)
            throw new CHttpException(404, 'Invalid request. Please do not repeat this request again.');

        $value = Yii::app()->request->getParam('value', null);
        $field = Yii::app()->request->getParam('field', null);
        $vvmp1 = Yii::app()->request->getParam('vvmp1', null);

        $whiteList = array(
            'vvmp10', 'vvmp11', 'vvmp12', 'vvmp13', 'vvmp14', 'vvmp15', 'vvmp16',
            'vvmp17', 'vvmp18', 'vvmp19', 'vvmp20', 'vvmp21', 'vvmp22', 'vvmp23',
        );
        if (in_array($field, $whiteList))
            $attr = array(
                $field => $value
            );

        $criteria = new CDbCriteria();
        $criteria->compare('vvmp1', $vvmp1);

        $model = Vvmp::model()->find($criteria);
        if (empty($model))
            $error = true;
        else
            $error = !$model->saveAttributes($attr);

        Yii::app()->end(CJSON::encode(array('error' => $error, 'errors' => $model->getErrors())));
    }

    public function actionInsertVmpMark()
    {
        if (! Yii::app()->request->isAjaxRequest)
            throw new CHttpException(404, 'Invalid request. Please do not repeat this request again.');

        $vmp1  = Yii::app()->request->getParam('vvmp1', null);
        $vmp2  = Yii::app()->request->getParam('st1', null);
        $vmp3  = Yii::app()->request->getParam('module', null);
        $field = Yii::app()->request->getParam('field', null);
        $value = Yii::app()->request->getParam('value', null);

        $whiteList = array('vmp4', 'vmp5', 'vmp6', 'vmp7');
        if (in_array($field, $whiteList))
            $attr = array(
                $field => $value
            );


        $criteria = new CDbCriteria();
        $criteria->compare('vmp1', $vmp1);
        $criteria->compare('vmp2', $vmp2);
        $criteria->compare('vmp3', $vmp3);

        $model = Vmp::model()->find($criteria);
        if (empty($model))
            $error = true;
        else
            $error = !$model->saveAttributes($attr);

        // recalculate vmp4 if vmp5, vmp6 or vmp7 were changed
        if (! $error && in_array($field, array('vmp5', 'vmp6', 'vmp7')))
            $model->recalculateVmp4();

        Yii::app()->end(CJSON::encode(array('error' => $error, 'errors' => $model->getErrors())));
    }

    public function actionUpdateStus()
    {
        if (! Yii::app()->request->isAjaxRequest)
            throw new CHttpException(404, 'Invalid request. Please do not repeat this request again.');

        $value = Yii::app()->request->getParam('value', null);
        $field = Yii::app()->request->getParam('field', null);
        $vvmp1 = Yii::app()->request->getParam('vvmp1', null);
        $st1   = Yii::app()->request->getParam('st1', null);

        $whiteList = array(
            'stus3'
        );
        if (in_array($field, $whiteList))
            $attr = array(
                $field => $value
            );

        $vvmp = Vvmp::model()->findByPk($vvmp1);

        $criteria = new CDbCriteria();
        $criteria->compare('stus1',  $st1);
        $criteria->compare('stus18', $vvmp->vvmp3);
        $criteria->compare('stus19', 8);
        $criteria->compare('stus20', $vvmp->vvmp4);
        $criteria->compare('stus21', $vvmp->vvmp5);

        $model = Stus::model()->find($criteria);
        if (empty($model))
            $error = true;
        else
            $error = !$model->saveAttributes($attr);

        $res = array(
            'error' => $error
        );

        if (! empty($model))
            $res += array('errors' => $model->getErrors());

        Yii::app()->end(CJSON::encode($res));
    }

    public function actionCloseModule()
    {
        if (! Yii::app()->request->isAjaxRequest)
            throw new CHttpException(404, 'Invalid request. Please do not repeat this request again.');

        $vvmp1 = Yii::app()->request->getParam('vvmp1', null);

        if (empty($vvmp1))
            throw new CHttpException(404, 'Invalid request. Please do not repeat this request again.');

        $vvmp = Vvmp::model()->findByPk($vvmp1);

        $res = $vvmp->saveAttributes(array(
            'vvmp7' => date('Y-m-d H:i:s')
        ));

        Yii::app()->end(CJSON::encode(array('res' => $res)));
    }

    public function actionRenderExtendedModule()
    {
        if (! Yii::app()->request->isAjaxRequest)
            throw new CHttpException(404, 'Invalid request. Please do not repeat this request again.');

        $uo1  = Yii::app()->request->getParam('uo1', null);
        $gr1  = Yii::app()->request->getParam('gr1', null);
        $d1   = Yii::app()->request->getParam('d1', null);
        $module_num = Yii::app()->request->getParam('module_num', null);


        $model = new FilterForm;
        $model->scenario = 'modules';
        $model->group = $gr1;
        $model->discipline = $d1;
        $moduleInfo = $this->fillModulesFor($model);


        if (empty($uo1) || empty($gr1) || empty($d1) || empty($module_num))
            throw new CHttpException(404, 'Invalid request. Please do not repeat this request again.');

        $students = St::model()->getStudentsForJournal($gr1, $uo1);

        $this->renderPartial('modules/_extended_module', array(
            'students'   => $students,
            'moduleInfo' => $moduleInfo,
            'module_num' => $module_num
        ));
    }

    public function actionThematicPlan()
    {
        $model = new FilterForm();
        $model->scenario = 'thematicPlan';

        if (isset($_REQUEST['FilterForm']))
            $model->attributes=$_REQUEST['FilterForm'];

        $this->render('thematicPlan', array(
            'model' => $model
        ));
    }

    public function actionRenderNrTheme()
    {
        if (! Yii::app()->request->isAjaxRequest)
            throw new CHttpException(404, 'Invalid request. Please do not repeat this request again.');

        $nr1 = Yii::app()->request->getParam('nr1', null);
        $d1  = Yii::app()->request->getParam('d1', null);

        if (empty($nr1) || empty($d1))
            throw new CHttpException(404, 'Invalid request. Please do not repeat this request again.');

        $model = Nr::model()->findByPk($nr1);
        if (isset($_REQUEST['Nr'])) {
            $model->attributes = $_REQUEST['Nr'];
            $model->save();
        }

        $html = $this->renderPartial('thematicPlan/_theme', array(
            'model' => $model,
            'd1'    => $d1
        ), true);

        $res = array(
            'html' => $html,
            'errors' => $model->getErrors(),
        );

        Yii::app()->end(CJSON::encode($res));
    }

    public function actionDeleteNrTheme()
    {
        if (! Yii::app()->request->isAjaxRequest)
            throw new CHttpException(404, 'Invalid request. Please do not repeat this request again.');

        $nr1 = Yii::app()->request->getParam('nr1', null);

        $deleted = (bool)Nr::model()->deleteByPk($nr1);

        $res = array(
            'deleted' => $deleted
        );

        Yii::app()->end(CJSON::encode($res));
    }
}