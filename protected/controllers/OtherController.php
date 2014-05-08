<?php

class OtherController extends Controller
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
                ),
                'expression' => 'Yii::app()->user->isAdmin || Yii::app()->user->isTch',
            ),
            array('deny',
                'users' => array('*'),
            ),
        );
    }



    public function actionPhones()
    {
        $phones = Tso::model()->getAllPhonesInArray();

        $this->render('phones', array(
            'phones' => $phones
        ));
    }


}