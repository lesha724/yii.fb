<?php

class PaymentController extends Controller
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



    public function actionHostel()
    {
        $plans    = Spob::model()->getPlan();
        $payments = Sob::model()->getPayments();

        $this->render('hostel', array(
            'plans' => $plans,
            'payments' => $payments,
        ));
    }

    public function actionEducation()
    {
        $plans    = Spo::model()->getPlan();
        $payments = So::model()->getPayments();

        $this->render('education', array(
            'plans' => $plans,
            'payments' => $payments,
        ));
    }
}