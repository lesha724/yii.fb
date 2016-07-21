<?php

class MobileController extends Controller
{
    public $layout='/layouts/mobile';

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
                ),
                'expression' => 'Yii::app()->user->isTch',
            ),
            array(
                'allow',
                'actions' => array(
                    'timeTableGroup',
                    'timeTableStudent',
                    'timeTableTeacher',
                    'timeTableSelf'
                ),
                'users' => array('*'),
            ),
            array('deny',
                'users' => array('*'),
            ),
        );
    }
//---------------------Journal---------------------------------------------------------------
    public function actionJournal()
    {
        $model = new FilterForm;
        $model->scenario = 'journal';
        /*if (isset($_REQUEST['showRetake'])) {
            Yii::app()->user->setState('showRetake',(int)$_REQUEST['showRetake']);
            unset($_REQUEST['showRetake']);
        }*/
        if (isset($_REQUEST['FilterForm']))
            $model->attributes=$_REQUEST['FilterForm'];

        $read_only=false;

        $this->render('journal', array(
            'model' => $model,
            'read_only' => $read_only,
        ));
    }

    public function actionTimeTableGroup()
    {
        $model = new TimeTableForm;

        $model->scenario = 'mobile-group';

        $model->dateLesson = Yii::app()->session['dateLesson'];

        if (isset($_REQUEST['timeTable'])) {
            Yii::app()->user->setState('timeTable',(int)$_REQUEST['timeTable']);
            unset($_REQUEST['timeTable']);
        }
        if (isset($_REQUEST['TimeTableForm']))
            $model->attributes=$_REQUEST['TimeTableForm'];



        $timeTable = array();
        if (! empty($model->group))
        {
            $timeTable=Gr::getTimeTable($model->group, $model->dateLesson, $model->dateLesson, 0);
        }

        $this->render('timeTable/group', array(
            'model'      => $model,
            'timeTable'  => $timeTable,
            'rz'         => Rz::model()->getRzArray($model->filial),
        ));
    }

    public function actionTimeTableStudent()
    {
        $model = new TimeTableForm;

        $model->scenario = 'mobile-student';

        $model->dateLesson = Yii::app()->session['dateLesson'];

        if (isset($_REQUEST['timeTable'])) {
            Yii::app()->user->setState('timeTable',(int)$_REQUEST['timeTable']);
            unset($_REQUEST['timeTable']);
        }
        if (isset($_REQUEST['TimeTableForm']))
            $model->attributes=$_REQUEST['TimeTableForm'];



        $timeTable = array();
        if (! empty($model->student))
        {
            $timeTable=Gr::getTimeTable($model->student, $model->dateLesson, $model->dateLesson, 1);
        }

        $this->render('timeTable/student', array(
            'model'      => $model,
            'timeTable'  => $timeTable,
            'rz'         => Rz::model()->getRzArray($model->filial),
        ));
    }

    public function actionTimeTableTeacher()
    {
        $model = new TimeTableForm;

        $model->scenario = 'mobile-teacher';

        $model->dateLesson = Yii::app()->session['dateLesson'];

        if (isset($_REQUEST['timeTable'])) {
            Yii::app()->user->setState('timeTable',(int)$_REQUEST['timeTable']);
            unset($_REQUEST['timeTable']);
        }
        if (isset($_REQUEST['TimeTableForm']))
            $model->attributes=$_REQUEST['TimeTableForm'];



        $timeTable = array();
        if (! empty($model->teacher))
        {
            $timeTable=Gr::getTimeTable($model->teacher, $model->dateLesson, $model->dateLesson, 2);
        }

        $this->render('timeTable/teacher', array(
            'model'      => $model,
            'timeTable'  => $timeTable,
            'rz'         => Rz::model()->getRzArray($model->filial),
        ));
    }

    public  function actionTimeTableSelf()
    {
        $model = new TimeTableForm;
        $model->scenario = 'mobile-self';
        if (isset($_REQUEST['TimeTableForm']))
            $model->attributes=$_REQUEST['TimeTableForm'];

        $model->dateLesson = Yii::app()->session['dateLesson'];
        if(Yii::app()->user->isStd)
        {
            $model->student=Yii::app()->user->dbModel->st1;
            $timeTable=Gr::getTimeTable($model->student, $model->dateLesson, $model->dateLesson, 1);
        }
        elseif(Yii::app()->user->isTch)
        {
            $model->teacher=Yii::app()->user->dbModel->p1;
            $timeTable=Gr::getTimeTable($model->teacher, $model->dateLesson, $model->dateLesson, 2);

        }else
            throw new CHttpException(404, 'Invalid request. Please do not repeat this request again.');

        $this->render('timeTable/self', array(
            'model'      => $model,
            'timeTable'  => $timeTable,
            'rz'         => Rz::model()->getRzArray($model->filial),
        ));
    }
}