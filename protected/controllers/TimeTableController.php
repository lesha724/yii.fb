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
            $date2 = date('d.m.Y', strtotime('+7 week', strtotime($date1)));


        $datetime1 = new DateTime($date1);
        $datetime2 = new DateTime($date2);
        $interval = $datetime1->diff($datetime2);

        if ($interval->days >= 100)
            $date2 = date('d.m.Y', strtotime('+7 week', strtotime($date1)));

        Yii::app()->session['date2'] = $date2;


        return parent::beforeAction($action);
    }



    public function actionTeacher()
    {
        $model = new TimeTableForm;
        $model->scenario = 'teacher';

        if (isset($_REQUEST['TimeTableForm']))
            $model->attributes=$_REQUEST['TimeTableForm'];

        $model->date1 = Yii::app()->session['date1'];
        $model->date2 = Yii::app()->session['date2'];

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

        $fullTimeTable = $model->fillTameTable($timeTable, 1);

        return array($minMax, $fullTimeTable);
    }


    public function actionGroup()
    {
        $model = new TimeTableForm;
        $model->scenario = 'group';

        if (isset($_REQUEST['TimeTableForm']))
            $model->attributes=$_REQUEST['TimeTableForm'];

        $model->date1 = Yii::app()->session['date1'];
        $model->date2 = Yii::app()->session['date2'];

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


    public function actionStudent()
    {
        $model = new TimeTableForm;
        $model->scenario = 'student';

        if (isset($_REQUEST['TimeTableForm']))
            $model->attributes=$_REQUEST['TimeTableForm'];

        $model->date1 = Yii::app()->session['date1'];
        $model->date2 = Yii::app()->session['date2'];

        $timeTable = $minMax = $maxLessons = array();
        if (! empty($model->student))
            list($minMax, $timeTable) = $this->generateStudentTimeTable($model);


        $this->render('student', array(
            'model'      => $model,
            'timeTable'  => $timeTable,
            'minMax'     => $minMax,
            'rz'         => Rz::model()->getRzArray(),
        ));
    }

    public function generateStudentTimeTable(TimeTableForm $model)
    {
        $timeTable = St::getTimeTable($model->student, $model->date1, $model->date2);
        $minMax    = $model->getMinMaxLessons($timeTable);

        $fullTimeTable = $model->fillTameTable($timeTable, 2);

        return array($minMax, $fullTimeTable);
    }


    public function actionClassroom()
    {
        $model = new TimeTableForm;
        $model->scenario = 'classroom';

        if (isset($_REQUEST['TimeTableForm']))
            $model->attributes=$_REQUEST['TimeTableForm'];

        $model->date1 = Yii::app()->session['date1'];
        $model->date2 = Yii::app()->session['date2'];

        $timeTable = $minMax = $maxLessons = array();
        if ($model->validate())
            list($minMax, $timeTable) = $this->generateClassroomTimeTable($model);


        $this->render('classroom', array(
            'model'      => $model,
            'timeTable'  => $timeTable,
            'minMax'     => $minMax,
            'rz'         => Rz::model()->getRzArray(),
        ));
    }

    public function generateClassroomTimeTable(TimeTableForm $model)
    {
        $timeTable = A::getTimeTable($model->classroom, $model->date1, $model->date2);
        $minMax    = $model->getMinMaxLessons($timeTable);

        $fullTimeTable = $model->fillTameTable($timeTable, 3);

        return array($minMax, $fullTimeTable);
    }


    public function actionFreeClassroom()
    {
        $model = new TimeTableForm;
        $model->scenario = 'free-classroom';

        $model->date1 = Yii::app()->session['date1'];
        $model->date2 = Yii::app()->session['date2'];

        $classrooms = $occupiedRooms = array();
        if (isset($_REQUEST['TimeTableForm'])){

            $model->attributes=$_REQUEST['TimeTableForm'];

            if ($model->validate()) {
                $classrooms    = A::model()->getClassRooms($model->filial, $model->housing);
                $occupiedRooms = A::model()->getOccupiedRooms($model);
            }
        }


        $this->render('freeClassroom', array(
            'model'         => $model,
            'classrooms'    => $classrooms,
            'occupiedRooms' => $occupiedRooms,
        ));
    }
}