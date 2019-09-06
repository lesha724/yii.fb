<?php
/**
 * Created by PhpStorm.
 * User: neffa
 * Date: 16.05.2018
 * Time: 10:33
 */

class PortfolioFarmController extends Controller
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
                    'index',
                    'changeField'
                ),
                'expression' => 'Yii::app()->user->isTch ||Yii::app()->user->isStd || Yii::app()->user->isAdmin',
            ),
            array('allow',
                'actions' => array(

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
        if(Yii::app()->core->universityCode!=U_FARM)
            throw new CHttpException(403, tt('Данный сервис не активный.'));

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
    public function actionIndex()
    {
        $model = new TimeTableForm;
        $model->scenario = 'student';

        if (Yii::app()->user->isTch) {
            $params = array();
            if (!isset($_REQUEST['TimeTableForm'])) {
                if (isset(Yii::app()->session['TimeTableForm'])){
                    $params=Yii::app()->session['TimeTableForm'];
                }
            }
            else{
                $params = $_REQUEST['TimeTableForm'];
            }
            $model->attributes = $params;
            Yii::app()->session['TimeTableForm']=$params;

        } elseif (Yii::app()->user->isStd) {

            $model->student = Yii::app()->user->dbModel->st1;
        } else
            throw new CHttpException(404, 'You don\'t have an access to this service');

        $this->render('index', array(
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

    /**
     * Проверка доступа к студенту
     * @param int $st1
     * @return bool
     * @throws CException
     */
    private function _checkPermission($st1){
        if(Yii::app()->user->isAdmin)
            return true;

        if(Yii::app()->user->isStd) {
            return $st1 == Yii::app()->user->dbModel->st1;
        }

        if(Yii::app()->user->isTch){
            $p = Yii::app()->user->dbModel;
            return $p->isDekanForStudent($st1) || $p->isKuratorForStudent($st1);
        }

        return false;
    }

    /**
     * @throws CException
     * @throws CHttpException
     */
    public function actionChangeField(){
        if (!Yii::app()->request->isAjaxRequest)
            throw new CHttpException(405, 'Invalid request. Please do not repeat this request again.');

        $st1 = Yii::app()->request->getParam('st1', null);
        $id = Yii::app()->request->getParam('id', null);
        $value = Yii::app()->request->getParam('value', null);

        if(empty($id) || empty($value) || empty($st1))
            throw new CHttpException(400, tt('Не все данные переданны'));

        if(!in_array($id, Stportfolio::model()->getFieldsIdList()))
            throw new CHttpException(400, tt('Неверные входящие данные'));

        if(!$this->_checkPermission($st1))
            throw new CHttpException(403, tt('Нет доступа к данному студенту'));


    }
}