<?php

class ListController extends Controller
{
    public function filters() {

        return array(
            'accessControl',
        );
    }

    public function accessRules() {

        return array(
            /*array('allow',
                'actions' => array(
                    'journal',
                ),
                'expression' => 'Yii::app()->user->isAdmin || Yii::app()->user->isTch',
            ),*/
            array('allow',
                'actions' => array('group','chair','searchStudent')
            ),
            array('deny',
                'users' => array('*'),
            ),
        );
    }
	
    public function actionGroup()
    {
        $model = new TimeTableForm();
        $model->scenario = 'list-group';

        if (isset($_REQUEST['TimeTableForm']))
            $model->attributes=$_REQUEST['TimeTableForm'];
        $res=PortalSettings::model()->findByPk(35);
        $ps35=0;
        if(!empty($res))
            $ps35 = $res->ps2;
        $dbh=null;
        if($ps35==1)
        {
            $string = Yii::app()->db->connectionString;
            $parts  = explode('=', $string);

            $host     = trim($parts[1].'d');
            $login    = Yii::app()->db->username;
            $password = Yii::app()->db->password;
            $dbh      = ibase_connect($host, $login, $password);
        }

        $student = new St;
        $student->unsetAttributes();

        $this->render('group', array(
            'model' => $model,
            'dbh'=> $dbh,
            'ps35'=>$ps35,
            'student'=>$student
        ));
    }
    
    public function actionChair()
    {
        $model = new TimeTableForm();
        $model->scenario = 'list-chair';

        if (isset($_REQUEST['TimeTableForm']))
            $model->attributes=$_REQUEST['TimeTableForm'];

        $this->render('chair', array(
            'model' => $model,
        ));
    }

    public function actionSearchStudent()
    {
        $model = new St;
        $model->unsetAttributes();
        if (isset($_REQUEST['St']))
            $model->attributes = $_REQUEST['St'];

        $this->render('/filter_form/default/search_student', array(
            'model' => $model,
        ));
    }
}