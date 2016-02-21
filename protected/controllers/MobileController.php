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

        $model->dateLesson = date('d.m.Y');

        if (isset($_REQUEST['timeTable'])) {
            Yii::app()->user->setState('timeTable',(int)$_REQUEST['timeTable']);
            unset($_REQUEST['timeTable']);
        }
        if (isset($_REQUEST['TimeTableForm']))
            $model->attributes=$_REQUEST['TimeTableForm'];



        $timeTable = array();
        if (! empty($model->group))
        {
            $timeTable=Gr::getTimeTable($model->group, $model->date1, $model->date2, 0);
        }

        $this->render('timeTable/group', array(
            'model'      => $model,
            'timeTable'  => $timeTable,
            'rz'         => Rz::model()->getRzArray($model->filial),
        ));
    }
}