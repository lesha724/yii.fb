<?php

class DocsController extends Controller
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
                    'farm',
                    'farmCreate',
                ),
                'expression' => 'Yii::app()->user->isAdmin || Yii::app()->user->isTch',
            ),
            array('deny',
                'users' => array('*'),
            ),
        );
    }



    public function actionFarm()
    {
        $docType = Yii::app()->request->getParam('docType', null);

        $this->render('farm/list', array(
            'docType' => $docType
        ));
    }

    public function actionFarmCreate()
    {
        $docType = Yii::app()->request->getParam('docType', null);

        $model = new Tddo;

        // input registration number
        $model->tddo7 = $model->getNextNumberFor($docType);

        if (isset($_REQUEST['tddo'])) {
            $model->attributes = $_REQUEST['tddo'];
        }


        $this->render('farm/create', array(
            'model' => $model,
            'docType' => $docType
        ));
    }


}