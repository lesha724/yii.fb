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
                    'uploadFile',
                    'addStpwork',
                    'updateStpwork',
                    'deleteStpwork'
                ),
                'expression' => 'Yii::app()->user->isTch ||Yii::app()->user->isStd || Yii::app()->user->isAdmin',
            ),
            array('allow',
                'actions' => array(
                    'block',
                    'unblock'
                ),
                'expression' => 'Yii::app()->user->isTch || Yii::app()->user->isAdmin',
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
            return ($p->isDekanForStudent($st1) || $p->isKuratorForStudent($st1));
        }

        return false;
    }

    /**
     * удаление поля
     * @param $id
     * @throws CDbException
     * @throws CException
     * @throws CHttpException
     */
    public function actionDeleteField($id){
        if (!Yii::app()->request->isPostRequest)
            throw new CHttpException(405, 'Invalid request. Please do not repeat this request again.');

        $field = Stportfolio::model()->findByPk(array('stportfolio0' => $id));
        if(empty($field))
            throw new CHttpException(500, tt('Ошибка сохранения'));

        if(!$this->_checkPermission($field->stportfolio2))
            throw new CHttpException(403, tt('Нет доступа к данному студенту'));

        if(!empty($field->stportfolio7))
            throw new CHttpException(403, tt('Элемент уже подтвержден'));

        if(!$field->delete())
            throw new CHttpException(500, tt('Ошибка удаления'));

        if(!empty($field->stportfolio60)){
            if ($field->stportfolio60->delete()) {
                $fileName = PortalSettings::model()->getSettingFor(PortalSettings::PORTFOLIO_PATH).'/'.$field->stportfolio60->stpfile7;
                unlink($fileName);
            } else {
                throw  new Exception('Ошибка удаления файла');
            }
        }

        $this->redirect(array('index'));
    }

    /**
     * добавления поля
     * @throws CException
     * @throws CHttpException
     */
    public function actionAddField(){
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


        $model = new Stportfolio();

        $p = new CHtmlPurifier();
        $model->stportfolio0 = new CDbExpression('GEN_ID(GEN_Stpwork, 1)');
        $model->stportfolio1 = $id;
        $model->stportfolio2 = $st1;
        $model->stportfolio3 = $p->purify($value);
        $model->stportfolio4 = Yii::app()->user->id;
        $model->stportfolio5 = date('Y-m-d H:i:s');

        if(!$model->save())
            throw new CHttpException(500, tt('Ошибка сохранения'));

        Yii::app()->end(CJSON::encode(array('error' => false)));
    }

    /**
     * Удаление файла
     * @param $id
     * @throws CException
     * @throws CHttpException
     */
    public function actionDeleteFile($id){
        if (!Yii::app()->request->isPostRequest)
            throw new CHttpException(405, 'Invalid request. Please do not repeat this request again.');

        $file = $this->_getFile($id, true);

        $fileName = PortalSettings::model()->getSettingFor(PortalSettings::PORTFOLIO_PATH).'/'.$file->stpfile7;

        if(!file_exists($fileName))
            throw new CHttpException(400,tt('Файл не существует или удален.'));

        try {
            if ($file->delete()) {
                unlink($fileName);
            } else {
                throw  new Exception('Ошибка');
            }

            $this->redirect(array('index'));

        }catch (Exception $error){
            throw new CHttpException(500, tt('Ошибка удаления: {error}', array(
                '{error}' => $error->getMessage()
            )));
        }
    }

    /**
     * Просомтр файла
     * @param $id
     * @throws CException
     * @throws CHttpException
     */
    public function actionFile($id){
        $file = $this->_getFile($id);

        $fileName = PortalSettings::model()->getSettingFor(PortalSettings::PORTFOLIO_PATH).'/'.$file->stpfile7;

        if(!file_exists($fileName))
            throw new CHttpException(400,tt('Файл не существует или удален.'));
        $ext = pathinfo($fileName,PATHINFO_EXTENSION);
        if(!in_array(mb_strtolower($ext), array('png', 'jpg')))
            header('Content-Type: application/'.$ext);
        else
            header('Content-Type: image/'.$ext);
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
     * @param $write bool для записи
     * @return Stpfile
     * @throws CException
     * @throws CHttpException
     */
    private function _getFile($id, $write = false){
        $file = Stpfile::model()->findByPk($id);

        if(empty($file))
            throw new CHttpException(404, tt('Файл не найден'));

        if(!$this->_checkPermission($file->stpfile5))
            throw new CHttpException(403, tt('Нет доступа к данному студенту'));

        if($write){
            if($file->stpfile6 == Stpfile::TYPE_STPORTFOLIO) {
                if (empty($file->stportfolios))
                    throw new CHttpException(400, tt('Не найден елемент'));
                foreach ($file->stportfolios as $stportfolio){
                    if(!empty($stportfolio->stportfolio7))
                        throw new CHttpException(403, tt('Элемент к которому привязан файл уже подтвержден'));
                }
            }

        }

        return $file;
    }

    /**
     * Загрузка файлов
     * @throws CException
     * @throws CHttpException
     */
    public function actionUploadFile(){

        $model = new CreateStpfileForm();

        $st1 = Yii::app()->request->getParam('st1', null);
        $id = Yii::app()->request->getParam('idField', null);
        $type = Yii::app()->request->getParam('type', null);

        if(empty($id) || empty($st1) || empty($type))
            throw new CHttpException(400, tt('Не все данные переданны'));

        if(!$this->_checkPermission($st1))
            throw new CHttpException(403, tt('Нет доступа к данному студенту'));

        if(isset($_POST['CreateStpfileForm'])) {
            $model->attributes = $_POST['CreateStpfileForm'];
            $model->st1 = $st1;
            $model->type = $type;
            $model->id = $id;
            $model->file=CUploadedFile::getInstance($model,'file');

            if ($model->validate()) {

                try {
                    if (!$model->save()) {
                        throw new CException(tt('Ошибка сохранения'));
                    }
                } catch (CException $error) {
                    throw new CHttpException(500, tt('Ошибка добавления файла: {error}', array(
                        '{error}' => $error->getMessage()
                    )));
                }
                Yii::app()->user->setFlash('success', 'Файл успешно добавлен');
                $this->redirect(array('index'));
            }
        }

        $this->render('upload-file',array(
            'model'=>$model,
            'type' => $type,
            'id' => $id
        ));
    }

    /**
     * Удаление елемента (учебно рабочая практика)
     * @param $id
     * @throws CException
     * @throws CHttpException
     */
    public function actionDeleteStpwork($id){
        if (!Yii::app()->request->isPostRequest)
            throw new CHttpException(405, 'Invalid request. Please do not repeat this request again.');

        $model = $this->_loadStpworkModel($id);

        if(!$this->_checkPermission($model->stpwork2))
            throw new CHttpException(403, tt('Нет доступа к данному студенту'));

        if ($model->delete()) {
            Yii::app()->user->setFlash('success', tt('Успешно удалено'));
        } else {
            Yii::app()->user->setFlash('error', tt('Ошибка удаления'));
        }

        $this->redirect(array('index'));
    }

    /**
     * @param $id
     * @throws CException
     * @throws CHttpException
     */
    public function actionAddStpwork($id)
    {
        $student = St::model()->findByPk($id);
        if(empty($student))
            throw new CHttpException(400, tt('Не найден студент'));

        if(!$this->_checkPermission($id))
            throw new CHttpException(403, tt('Нет доступа к данному студенту'));

        $model=new Stpwork;
        $model->unsetAttributes();

        if(isset($_POST['Stpwork']))
        {
            $model->attributes=$_POST['Stpwork'];
            if($model->validate())
            {
                $model->stpwork2 = $id;
                $model->stpwork1 = new CDbExpression('GEN_ID(GEN_Stpwork, 1)');
                $model->stpwork7 = Yii::app()->user->id;
                $model->stpwork8 = date('Y-m-d H:i:s');
                if($model->save())
                    $this->redirect(array('index'));
            }
        }

        $this->render('add-stpwork',array(
            'model'=>$model,
        ));
    }

    /**
     * @param $id
     * @throws CHttpException
     * @throws CException
     */
    public function actionUpdateStpwork($id)
    {
        $model=$this->_loadStpworkModel($id);

        $studentId = $model->stpwork2;

        if(!$this->_checkPermission($model->stpwork2))
            throw new CHttpException(403, tt('Нет доступа к данному студенту'));

        if(isset($_POST['Stpwork']))
        {
            $model->attributes=$_POST['Stpwork'];
            $model->stpwork2 = $studentId;
            $model->stpwork7 = Yii::app()->user->id;
            $model->stpwork8 = date('Y-m-d H:i:s');
            if($model->save())
                $this->redirect(array('index'));
        }

        $this->render('update-stpwork',array(
            'model'=>$model,
        ));
    }

    /**
     * Загрзка модели Stpwork по id
     * @param $id
     * @return Stpwork
     * @throws CHttpException
     */
    private function _loadStpworkModel($id)
    {
        $model=Stpwork::model()->findByPk($id);
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        if(!empty($model->stpwork9))
            throw new CHttpException(403, tt('Элемент уже подтвержден'));

        return $model;
    }
}