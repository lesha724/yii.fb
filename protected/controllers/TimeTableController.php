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
            $date2 = date('d.m.Y', strtotime('+8 week', strtotime($date1)));

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
            'model'      => $model,
            'timeTable'  => $timeTable,
            'minMax'     => $minMax,
            'rz'         => Rz::model()->getRzArray(),
        ));
    }

    public function generateTeacherTimeTable(TimeTableForm $model)
    {
        $timeTable = P::getTimeTable($model->teacher, $model->date1, $model->date2);
        $minMax    = $model->getMinMaxLessons($timeTable);

        $fullTimeTable = $model->fillTameTableForTeacher($timeTable, $model);

        return array($minMax, $fullTimeTable);
    }


    public function actionGroup()
    {
        $model = new TimeTableForm;
        $model->scenario = 'group';

        $model->date1 = Yii::app()->session['date1'];
        $model->date2 = Yii::app()->session['date2'];

        if (isset($_REQUEST['TimeTableForm']))
            $model->attributes=$_REQUEST['TimeTableForm'];

        $timeTable = $minMax = $maxLessons = array();
        if (! empty($model->group))
            list($minMax, $timeTable, $maxLessons) = $this->generateGroupTimeTable($model);


        $this->render('group', array(
            'model'      => $model,
            'timeTable'  => $timeTable,
            'minMax'     => $minMax,
            'maxLessons' => $maxLessons,
            'rz'         => Rz::model()->getRzArray(),
        ));
    }

    public function generateGroupTimeTable(TimeTableForm $model)
    {
        $timeTable = Gr::getTimeTable($model->group, $model->date1, $model->date2);
        $minMax    = $model->getMinMaxLessons($timeTable);

        list($fullTimeTable, $maxLessons) = $model->fillTameTableForGroup($timeTable);

        return array($minMax, $fullTimeTable, $maxLessons);
    }
}