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
                    'farm'
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

        $this->render('farm', array(
            'docType' => $docType
        ));
    }


}