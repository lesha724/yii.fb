<?php

class TimeTableController extends Controller
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

    public function beforeAction($action)
    {
        $date1 = isset($_REQUEST['TimeTableForm']['date1']) ? $_REQUEST['TimeTableForm']['date1'] : null;
        if ($date1 === null)
            $date1 = Yii::app()->session['date1'];
        if ($date1 === null)
            $date1 = date('d.m.Y');

        Yii::app()->session['date1'] = $date1;


        $date2 = isset($_REQUEST['TimeTableForm']['date2']) ? $_REQUEST['TimeTableForm']['date2'] : null;
        if ($date2 === null)
            $date2 = Yii::app()->session['date2'];
        if ($date2 === null)
            $date2 = date('d.m.Y', strtotime('+4 week', strtotime($date1)));

        Yii::app()->session['date2'] = $date2;


        return parent::beforeAction($action);
    }

    public function actionTeacher()
    {
        $model = new TimeTableForm;
        $model->scenario = 'teacher';

        $model->date1 = Yii::app()->session['date1'];
        $model->date2 = Yii::app()->session['date2'];

        if (isset($_REQUEST['TimeTableForm']))
            $model->attributes=$_REQUEST['TimeTableForm'];

        $timeTable = $minMax = array();
        if (! empty($model->teacher))
            list($minMax, $timeTable) = $this->generateTeacherTimeTable($model);


        $this->render('teacher', array(
            'model'     => $model,
            'timeTable' => $timeTable,
            'minMax'    => $minMax,
        ));
    }

    public function generateTeacherTimeTable(TimeTableForm $model)
    {
        $timeTable = P::getTimeTable($model->teacher, $model->date1, $model->date2);
        $minMax    = $model->getMinMaxLessons($timeTable);

        $fullTimeTable = $model->fillTameTableForTeacher($timeTable, $model);

        return array($minMax, $fullTimeTable);
    }

}