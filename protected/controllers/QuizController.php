<?php
/**
 * Created by PhpStorm.
 * User: neffa
 * Date: 16.11.2018
 * Time: 14:27
 */

/**
 * Опросы
 * Class QuizController
 */
class QuizController extends Controller
{
    public function filters() {

        return array(
            'accessControl',
            'checkPermission'
        );
    }

    public function accessRules() {

        return array(
            array('allow',
                'actions' => array(
                    'index'
                ),
                'expression' => 'Yii::app()->user->isDoctor || Yii::app()->user->isTch ',
            ),
            array('deny',
                'users' => array('*'),
            ),
        );
    }

    public function filterCheckPermission($filterChain)
    {
        if(!Yii::app()->user->isAdmin) {
            $grants = Yii::app()->user->dbModel->grants;

            if (empty($grants))
                throw new CHttpException(403, 'Invalid request. You don\'t have access to the service.');

            if ($grants->getGrantsFor(Grants::QUIZ) != 1)
                throw new CHttpException(403, 'Invalid request. You don\'t have access to the service.');
        }
        $filterChain->run();
    }

    /**
     * Опросник
     */
    public function actionIndex()
    {
        $model = new TimeTableForm;
        $model->scenario = 'student';

        if (isset($_REQUEST['TimeTableForm']))
            $model->attributes=$_REQUEST['TimeTableForm'];

        $this->render('index', array(
            'model'      => $model
        ));
    }
}