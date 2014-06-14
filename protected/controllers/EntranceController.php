<?php

class EntranceController extends Controller
{
    public function filters() {

        return array(
            //'accessControl',
        );
    }

    public function accessRules() {

        return array(
            array('allow',
                'actions' => array(
                    ''
                ),
                'expression' => 'Yii::app()->user->isAdmin || Yii::app()->user->isTch',
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



    public function actionDocumentReception()
    {
        $model = new FilterForm;
        $model->scenario = 'documentReception';

        $dateEntranceBegin  = PortalSettings::model()->findByPk(23)->getAttribute('ps2');
        $model->currentYear = date('Y', strtotime($dateEntranceBegin));

        if (isset($_REQUEST['FilterForm'])) {
            $model->attributes=$_REQUEST['FilterForm'];
        }

        $this->render('documentReception', array(
            'model' => $model
        ));
    }

}