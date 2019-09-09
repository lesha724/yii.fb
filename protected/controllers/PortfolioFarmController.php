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
                    'changeField',
                    'deleteFile',
                    'file',
                    'uploadFile'
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
     * @throws CException
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

        if(!empty($model->student))
            if(!$this->_checkPermission($model->student))
                throw new CHttpException(403, tt('Нет доступа к данному студенту'));

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

        if(empty($id) || empty($st1))
            throw new CHttpException(400, tt('Не все данные переданны'));

        if(!in_array($id, Stportfolio::model()->getFieldsIdList()))
            throw new CHttpException(400, tt('Неверные входящие данные'));

        if(!$this->_checkPermission($st1))
            throw new CHttpException(403, tt('Нет доступа к данному студенту'));


        $model = Stportfolio::model()->findByAttributes(array('stportfolio1' => $id, 'stportfolio2' => $st1));
        if(empty($model))
            $model = new Stportfolio();

        if($model->stportfolio6 == 1)
            throw new CHttpException(400, tt('Изменение запрещено! Данные уже подтвержденны!'));

        $model->stportfolio1 = $id;
        $model->stportfolio2 = $st1;
        $model->stportfolio3 = $value;
        $model->stportfolio4 = Yii::app()->user->id;
        $model->stportfolio5 = date('Y-m-d H:i:s');
        $model->stportfolio6 = 0;
        $model->stportfolio7 = $model->stportfolio8 = null;

        if(!$model->save())
            throw new CHttpException(500, tt('Ошибка сохранения'));

        Yii::app()->end(CJSON::encode(array('error' => false)));
    }

    /**
     * @param $id
     * @throws CException
     * @throws CHttpException
     */
    public function actionDeleteFile($id){
        if (!Yii::app()->request->isPostRequest)
            throw new CHttpException(405, 'Invalid request. Please do not repeat this request again.');

        $file = $this->_getFile($id);

        $fileName = PortalSettings::model()->getSettingFor(PortalSettings::PORTFOLIO_PATH).'/'.$id.'.'.$file->stpfile2;

        if(!file_exists($fileName))
            throw new CHttpException(400,tt('Файл не существует или удален.'));

        try {
            if ($file->delete()) {
                unlink($fileName);
            } else {
                throw  new Exception('Ошибка');
            }

            Yii::app()->end(CJSON::encode(array('error' => false)));

        }catch (Exception $error){
            throw new CHttpException(500, tt('Ошибка удаления: {error}', array(
                '{error}' => $error->getMessage()
            )));
        }
    }

    /**
     * @param $id
     * @throws CException
     * @throws CHttpException
     */
    public function actionFile($id){
        $file = $this->_getFile($id);

        $fileName = PortalSettings::model()->getSettingFor(PortalSettings::PORTFOLIO_PATH).'/'.$id.'.'.$file->stpfile2;

        if(!file_exists($fileName))
            throw new CHttpException(400,tt('Файл не существует или удален.'));

        header('Content-Type: application/'.pathinfo($fileName,PATHINFO_EXTENSION));
        header('Content-Disposition: inline; filename="'.basename($fileName).'"');
        header('Content-Transfer-Encoding: binary');
        header('Accept-Ranges: bytes');
        header('Content-Length: ' . filesize($fileName));
        @readfile($fileName);
        exit;
    }

    /**
     * Файл по айди
     * @param $id int
     * @return Stpfile
     * @throws CException
     * @throws CHttpException
     */
    private function _getFile($id){
        $file = Stpfile::model()->findByPk($id);

        if(empty($file))
            throw new CHttpException(404, tt('Файл не найден'));

        if(!$this->_checkPermission($file->stpfile5))
            throw new CHttpException(403, tt('Нет доступа к данному студенту'));

        return $file;
    }


    public function uploadFile(){
        //$this->stpfile3 = Yii::app()->user->id;
        //$this->stpfile4 = date('Y-m-d H:i:s');
    }
}