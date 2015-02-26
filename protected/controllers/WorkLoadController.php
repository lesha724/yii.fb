<?php

class WorkLoadController extends Controller
{
    public function filters() {

        return array(
            //'accessControl',
        );
    }

    public function accessRules() {

        return array(
            array('allow',
                'actions' => array(
                ),
                'expression' => 'Yii::app()->user->isAdmin || Yii::app()->user->isTch',
            ),
            array('deny',
                'users' => array('*'),
            ),
        );
    }



    public function actionTeacher()
    {
        $model = new FilterForm();
        $model->scenario = 'workLoad-teacher';

        list($year,$semester) = SH::getCurrentYearAndSem();
        $model->year     = $year;
        $model->semester = $semester;

        if (isset($_REQUEST['FilterForm']))
            $model->attributes=$_REQUEST['FilterForm'];


        $this->render('teacher', array(
            'model' => $model,
        ));
    }

    public function actionSelf()
    {
        $model = new FilterForm();
        $model->scenario = 'workLoad-teacher';

        list($year,$semester) = SH::getCurrentYearAndSem();
        $model->year     = $year;
        $model->semester = $semester;
        $model->teacher  = Yii::app()->user->dbModel->p1;

        if (isset($_REQUEST['FilterForm']))
            $model->attributes=$_REQUEST['FilterForm'];


        $this->render('self', array(
            'model' => $model,
        ));
    }

    public function actionAmount()
    {
        $model = new FilterForm();
        $model->scenario = 'workLoad-teacher';

        list($year,) = SH::getCurrentYearAndSem();
        $model->year = $year;

        if (isset($_REQUEST['FilterForm']))
            $model->attributes=$_REQUEST['FilterForm'];


        $this->render('amount', array(
            'model' => $model,
        ));
    }

    public function actionGetGroups()
    {
        if (! Yii::app()->request->isAjaxRequest)
            throw new CHttpException(404, 'Please, do not repeat this request nay more!');

        $ids  = Yii::app()->request->getParam('ids', null);
        $year = Yii::app()->request->getParam('year', null);
        $sem  = Yii::app()->request->getParam('sem', null);

        if (empty($ids) || empty($year) || is_null($sem))
            throw new CHttpException(404, 'Please, do not repeat this request nay more!');

        $criteria = new CDbCriteria();
        $criteria->addInCondition('gr1', unserialize($ids));

        $models = Gr::model()->findAll($criteria);

        $html = $this->renderPartial('_groups', array(
            'models' => $models,
            'year'   => $year,
            'sem'    => $sem,
        ), true);

        Yii::app()->end(CJSON::encode(array('html' => $html)));
    }
}