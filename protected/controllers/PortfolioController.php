<?php
/**
 * Created by PhpStorm.
 * User: neffa
 * Date: 16.05.2018
 * Time: 10:33
 */

class PortfolioController extends Controller
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
                    'teacher'
                ),
                'expression' => 'Yii::app()->user->isTch || Yii::app()->user->isAdmin',
            ),
            array('allow',
                'actions' => array(
                    'student',
                ),
                'expression' => 'Yii::app()->user->isStd || Yii::app()->user->isAdmin',
            ),
            array('allow',
                'actions' => array(
                    'uploadFile',
                ),
                'users' => array('@'),
            ),
            array('deny',
                'users' => array('*'),
            ),
        );
    }

    /**
     * Дополнительная проверка
     * @param $filterChain
     * @throws CHttpException
     */
    public function filterCheckPermission($filterChain)
    {
        if(PortalSettings::model()->getSettingFor(PortalSettings::USE_PORTFOLIO)==0)
            throw new CHttpException(403, tt('Данный сервис не активный, обратитесь к администратору.'));

        $parh = PortalSettings::model()->getSettingFor(PortalSettings::PORTFOLIO_PATH);
        if(empty($parh))
            throw new CHttpException(403, tt('Не заданы необходимые настройки, обратитесь к администратору.'));

        if(!$this->_checkPath())
            throw new CHttpException(403, tt('Неверные настройки, обратитесь к администратору.'));

        $filterChain->run();
    }

    /**
     *
     * @throws CHttpException
     */
    public function actionStudent()
    {
        $model = new TimeTableForm;
        $model->scenario = 'student';
        if (isset($_REQUEST['TimeTableForm']))
            $model->attributes=$_REQUEST['TimeTableForm'];

        if (Yii::app()->user->isAdmin) {

        } elseif (Yii::app()->user->isStd) {

            $model->student = Yii::app()->user->dbModel->st1;
        } else
            throw new CHttpException(404, 'You don\'t have an access to this service');

        $this->render('student', array(
            'model'=>$model
        ));
    }

    /**
     * @throws CHttpException
     */
    public function actionTeacher()
    {
        $model = new TimeTableForm;
        $model->scenario = 'teacher';
        if (isset($_REQUEST['TimeTableForm']))
            $model->attributes=$_REQUEST['TimeTableForm'];

        if (Yii::app()->user->isAdmin) {

        } elseif (Yii::app()->user->isTch) {

            $model->teacher = Yii::app()->user->dbModel->p1;
        } else
            throw new CHttpException(404, 'You don\'t have an access to this service');

        $this->render('teacher', array(
            'model'=>$model
        ));
    }

    /**
     * Проыерка существования директории
     * @return bool
     */
    private function _checkPath(){
        $path = PortalSettings::model()->getSettingFor(PortalSettings::PORTFOLIO_PATH);

        if(empty($path))
            return false;

        return is_dir($path);
    }
}