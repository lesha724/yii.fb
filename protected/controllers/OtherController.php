<?php

class OtherController extends Controller
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
                    'orderLesson'
                ),
                'expression' => 'Yii::app()->user->isTch',
            ),
            array('allow',
                'actions' => array(
                    'gostem',
                    'deleteGostem'
                ),
                'expression' => 'Yii::app()->user->isStd',
            ),
            array('allow',
                'actions' => array(
                    'phones'
                ),
            ),
            array('deny',
                'users' => array('*'),
            ),
        );
    }



    public function actionPhones()
    {
        $department = Yii::app()->request->getParam('department', null);

        $phones = Tso::model()->getAllPhonesInArray($department);

        $this->render('phones', array(
            'phones' => $phones,
            'department' => $department
        ));
    }

    public function actionGostem()
    {
        $model = new FilterForm;
        $model->scenario = 'gostem';

        if (isset($_REQUEST['FilterForm'])) {
            $model->attributes=$_REQUEST['FilterForm'];

            if (isset($_REQUEST['subscribe'])) {
                $nrst = new Nrst;
                $nrst->nrst1 = $model->nr1;
                $nrst->nrst2 = Yii::app()->user->dbModel->st1;
                $nrst->nrst3 = $model->gostem1;
                $nrst->save();
                $this->redirect('/other/gostem');
            }
        }


        $this->render('gostem', array(
            'model' => $model,
        ));
    }

    public function actionDeleteGostem()
    {
        if (! Yii::app()->request->isAjaxRequest)
            throw new CHttpException(404, 'Invalid request. Please do not repeat this request again.');

        $nrst1 = Yii::app()->request->getParam('nrst1', null);
        $nrst3 = Yii::app()->request->getParam('nrst3', null);

        if (empty($nrst1) || empty($nrst3))
            throw new CHttpException(404, 'Invalid request. Please do not repeat this request again.');

        $deleted = (bool)Nrst::model()->deleteAllByAttributes(array(
            'nrst1' => $nrst1,
            'nrst2' => Yii::app()->user->dbModel->st1,
            'nrst3' => $nrst3,
        ));

        $res = array(
            'deleted' => $deleted
        );

        Yii::app()->end(CJSON::encode($res));
    }

    public function actionOrderLesson()
    {
        $model = new TimeTableForm;
        $model->scenario = 'group';

        if (isset($_REQUEST['TimeTableForm']))
            $model->attributes=$_REQUEST['TimeTableForm'];

        $model->date1 = Yii::app()->session['date1'];
        $model->date2 = Yii::app()->session['date2'];

        $timeTable = $minMax = $maxLessons = array();
        if (! empty($model->group))
            list($minMax, $timeTable, $maxLessons) = $model->generateGroupTimeTable($model);


        $this->render('orderLesson', array(
            'model'      => $model,
            'timeTable'  => $timeTable,
            'minMax'     => $minMax,
            'maxLessons' => $maxLessons,
            'rz'         => Rz::model()->getRzArray(),
        ));
    }

}