<?php

class WorkPlanController extends Controller
{
    const SPECIALITY = 1;
    const GROUP = 2;
    const STUDENT = 3;

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



    public function actionStudent()
    {
        $model = new FilterForm();
        $model->scenario = 'workPlan-student';

        if (isset($_REQUEST['FilterForm']))
            $model->attributes=$_REQUEST['FilterForm'];


        $this->render('student', array(
            'model' => $model,
        ));
    }

    public function actionGroup()
    {
        $model = new FilterForm();
        $model->scenario = 'workPlan-group';

        if (isset($_REQUEST['FilterForm']))
            $model->attributes=$_REQUEST['FilterForm'];


        $this->render('group', array(
            'model' => $model,
        ));
    }

    public function actionSpeciality()
    {
        $model = new FilterForm();
        $model->scenario = 'workPlan-speciality';

        if (isset($_REQUEST['FilterForm']))
            $model->attributes=$_REQUEST['FilterForm'];


        $this->render('speciality', array(
            'model' => $model,
        ));
    }
}