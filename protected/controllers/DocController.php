<?php
/**
 * Created by PhpStorm.
 * User: Neff
 * Date: 14.12.2016
 * Time: 20:46
 */

class DocController extends Controller
{
    public function filters() {

        return array(
            'accessControl',
            'checkPermission -index'//не выполянеться для индекса
        );
    }

    public function accessRules() {

        return array(
            array('allow',
                'actions' => array(
                    'index',
                    'view'
                ),
                'expression' => 'Yii::app()->user->isAdmin || Yii::app()->user->isTch',
            ),
            array('deny',
                'users' => array('*'),
            ),
        );
    }

    public function filterCheckPermission($filterChain)
    {
        /*if(!Yii::app()->user->isAdmin) {
            $grants = Yii::app()->user->dbModel->grants;

            if (empty($grants))
                throw new CHttpException(404, 'Invalid request. You don\'t have access to the service.');

            if ($grants->grants5 != 1)
                throw new CHttpException(404, 'Invalid request. You don\'t have access to the service.');
        }*/
        $filterChain->run();
    }

    public function actionIndex()
    {
        $docType = Yii::app()->request->getParam('docType', null);
        $docYear = Yii::app()->request->getParam('docYear', null);

        $model = new Tddo();
        $model->unsetAttributes();

        //$model->tddo2 = $docType;

        if (isset($_GET['pageSize'])) {
            Yii::app()->user->setState('pageSize',(int)$_GET['pageSize']);
            unset($_GET['pageSize']);  // сбросим, чтобы не пересекалось с настройками пейджера
        }

        /*if (isset($_REQUEST['Tddo'])) {
            $model->scenario = 'filter';
            $model->attributes = $_REQUEST['Tddo'];
        }*/
        $model->scenario = 'filter';
        if (isset($_REQUEST['Tddo']))
        {
            $model->attributes = $_REQUEST['Tddo'];
            Yii::app()->user->setState('SearchParamsTddo', $_REQUEST['Tddo']);
        }
        else
        {
            $searchParams = Yii::app()->user->getState('SearchParamsTddo');
            if ( isset($searchParams) )
            {
                $model->attributes = $searchParams;
            }
        }

        $model->tddo2 = $docType;
        if(!empty($docYear))
            $model->tddo23 = $docYear;

        $this->render('index', array(
            //'docType' => $docType,
            'model'   => $model
        ));
    }

    public function loadModel($id)
    {
        $model=Tddo::model()->findByPk($id);
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }

    public function actionView($id){
        $model = $this->loadModel($id);

        if(!Yii::app()->user->isAdmin)
        {
            //проверка доступа
        }

        $this->render('view',array(
            'model'=>$model
        ));
    }
}