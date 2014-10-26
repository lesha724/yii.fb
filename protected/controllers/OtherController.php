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
                    'orderLesson', 'freeRooms', 'saveLessonOrder'
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
                    'phones',
                    'employment'
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

    public function actionFreeRooms()
    {
        if (! Yii::app()->request->isAjaxRequest)
            throw new CHttpException(404, 'Invalid request. Please do not repeat this request again.');

        $zpz6   = Yii::app()->request->getParam('zpz6', null);
        $zpz7   = Yii::app()->request->getParam('zpz7', null);
        $filial = Yii::app()->request->getParam('filial', null);

        if (empty($zpz6) || empty($zpz7))
            throw new CHttpException(404, 'Invalid request. Please do not repeat this request again.');

        $rooms = CHtml::listData(A::model()->getFreeRooms($filial, $zpz6, $zpz7), 'a1', 'a2', 'ka2');

        $html = CHtml::dropDownList('ZPZ[zpz8]', null, $rooms, array('style'=>'width:155px'));

        Yii::app()->end(
            CJSON::encode(array('html' => $html))
        );
    }

    public function actionSaveLessonOrder()
    {
        if (! Yii::app()->request->isAjaxRequest)
            throw new CHttpException(404, 'Invalid request. Please do not repeat this request again.');

        $res = null;

        $params = Yii::app()->request->getParam('params');
        $params = explode('/',$params);

        if (isset($_POST['ZPZ'])) {

            $model = new Zpz;
            $model->attributes = $_POST['ZPZ'];
            $model->zpz1 = new CDbExpression('GEN_ID(GEN_ZPZ, 1)');
            $model->zpz2 = $params[0];
            $model->zpz3 = $params[1];
            $model->zpz4 = $params[2];
            $model->zpz5 = $params[3];
            $model->zpz9 = Yii::app()->user->dbModel->p1;
            $model->zpz10 = new CDbExpression('CURRENT_TIMESTAMP');
            $res = $model->save();
        }

        Yii::app()->end(
            CJSON::encode(array(
                'res'    => $res,
                'errors' => isset($model)?$model->getErrors():null
            ))
        );
    }

    public function actionEmployment()
    {
        $st1 = Yii::app()->request->getParam('id', null);

        if (empty($st1)) {

            $model = new FilterForm;
            $model->scenario = 'employment';

            if (isset($_REQUEST['FilterForm']))
                $model->attributes=$_REQUEST['FilterForm'];

            $this->render('employment', array(
                'model' => $model,
            ));

        } else {

            $student = St::model()->findByPk($st1);

            $model = Sdp::model()->loadModel($st1);

            $user = Yii::app()->user;
            $isEditable = $user->isAdmin ||
                ($user->isStd && $user->dbModel->st1 == $st1);

            if ($isEditable && isset($_REQUEST['Sdp'])) {

                $model->attributes = $_REQUEST['Sdp'];
                $attr = array('sdp4', 'sdp26', 'sdp27', 'sdp28', 'sdp30', 'sdp31', 'sdp32', 'sdp33');
                if ($model->validate($attr)) {
                    $model->save(false);
                } else
                    Yii::app()->user->setFlash('error', tt('Пожалуйста, исправьте возникшие ошибки!'));

            }



            $this->render('employment/_st_info', array(
                'model'   => $model,
                'student' => $student,
                'isEditable' => $isEditable,
            ));

        }
    }

}